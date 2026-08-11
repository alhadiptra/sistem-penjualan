<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::where('user_id', Auth::id())
            ->with('product')
            ->get();

        $total = $carts->sum(function ($item) {
            return $item->product->harga * $item->qty;
        });

        return view('customer.cart', compact('carts', 'total'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $product = Product::find($request->product_id);

        if ($product->stok <= 0) {
            return back()->with('error', 'Stok produk habis!');
        }

        $cart = Cart::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($cart) {
            if ($cart->qty + 1 > $product->stok) {
                return back()->with('error', 'Stok tidak mencukupi!');
            }
            $cart->qty += 1;
            $cart->save();
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'qty' => 1,
            ]);
        }

        return back()->with('success', 'Produk ditambahkan ke keranjang!');
    }

    public function update(Request $request, Cart $cart)
    {
        if ($cart->user_id != Auth::id()) {
            abort(403);
        }

        $request->validate([
            'qty' => 'required|integer|min:1',
        ]);

        $product = $cart->product;

        if ($request->qty > $product->stok) {
            return back()->with('error', 'Stok tidak mencukupi!');
        }

        $cart->update(['qty' => $request->qty]);

        return back()->with('success', 'Keranjang diupdate!');
    }

    public function remove(Cart $cart)
    {
        if ($cart->user_id != Auth::id()) {
            abort(403);
        }

        $cart->delete();

        return back()->with('success', 'Produk dihapus dari keranjang!');
    }

    public function checkout()
    {
        $carts = Cart::where('user_id', Auth::id())
            ->with('product')
            ->get();

        if ($carts->isEmpty()) {
            return redirect()->route('customer.cart')
                ->with('error', 'Keranjang kosong!');
        }

        $total = $carts->sum(function ($item) {
            return $item->product->harga * $item->qty;
        });

        return view('customer.checkout', compact('carts', 'total'));
    }

    public function processCheckout(Request $request)
    {
        $request->validate([
            'metode_pembayaran' => 'required|in:tunai,qris',
            'jenis_pesanan' => 'required|in:diantar,ambil_toko',
            'total_harga' => 'required|numeric',
            'ongkir' => 'nullable|numeric',
            'catatan' => 'nullable|string',
        ]);

        if ($request->jenis_pesanan == 'diantar') {
            $request->validate([
                'alamat' => 'required|string',
                'kecamatan' => 'required|string', // ✅ TAMBAHKAN
                'no_hp' => 'required|string|max:20',
            ]);
        }

        $carts = Cart::where('user_id', Auth::id())
            ->with('product')
            ->get();

        if ($carts->isEmpty()) {
            return redirect()->route('customer.cart')
                ->with('error', 'Keranjang kosong!');
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'no_order' => Order::generateNoOrder(),
            'tanggal_order' => now(),
            'total_harga' => $request->total_harga,
            'ongkir' => $request->ongkir ?? 0,
            'metode_pembayaran' => $request->metode_pembayaran,
            'jenis_pesanan' => $request->jenis_pesanan,
            'alamat' => $request->alamat,
            'kecamatan' => $request->kecamatan, // ✅ TAMBAHKAN
            'no_hp' => $request->no_hp,
            'catatan' => $request->catatan,
            'status' => 'menunggu_pembayaran',
            'status_pembayaran' => 'belum_dibayar',
            'expired_at' => now()->addMinutes(15),
        ]);

        foreach ($carts as $cart) {
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $cart->product_id,
                'qty' => $cart->qty,
                'harga' => $cart->product->harga,
                'subtotal' => $cart->product->harga * $cart->qty,
            ]);

            $product = $cart->product;
            $product->stok -= $cart->qty;
            $product->save();
        }

        Cart::where('user_id', Auth::id())->delete();

        if ($request->metode_pembayaran == 'qris') {
            return redirect()->route('customer.qris', $order->id);
        }

        return redirect()->route('customer.orders')
            ->with('success', 'Pesanan #' . $order->no_order . ' berhasil dibuat!');
    }
}

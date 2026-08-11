<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\QrisService;
use Illuminate\Support\Facades\Auth;

class QrisController extends Controller
{
    protected $qrisService;

    public function __construct(QrisService $qrisService)
    {
        $this->qrisService = $qrisService;
    }

    public function index(Order $order)
    {
        if ($order->user_id != Auth::id()) {
            abort(403, 'Anda tidak memiliki akses ke pesanan ini.');
        }

        // Generate QRIS dinamis
        $qrisResult = $this->qrisService->generateQris($order->total_harga);

        return view('customer.qris', compact('order', 'qrisResult'));
    }

    public function confirmPayment(Order $order)
    {
        if ($order->user_id != Auth::id()) {
            abort(403, 'Anda tidak memiliki akses ke pesanan ini.');
        }

        $order->update([
            'status_pembayaran' => 'sudah_dibayar',
            'status' => 'diproses',
        ]);

        return redirect()->route('customer.orders')
            ->with('success', 'Pembayaran berhasil! Pesanan #' . $order->no_order . ' sedang diproses.');
    }
}

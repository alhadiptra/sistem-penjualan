<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('customer.orders', compact('orders'));
    }

    public function show(Order $order)
    {
        if ($order->user_id != Auth::id()) {
            abort(403);
        }

        $order->load('orderDetails.product');

        return view('customer.order-detail', compact('order'));
    }
}

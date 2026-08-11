<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalCustomers = User::where('role', 'customer')->count();
        $totalAdmins = User::where('role', 'admin')->count();
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $totalRevenue = Order::where('status', 'selesai')->sum('total_harga');

        return view('owner.dashboard', compact(
            'totalProducts',
            'totalCustomers',
            'totalAdmins',
            'totalOrders',
            'pendingOrders',
            'totalRevenue'
        ));
    }
}

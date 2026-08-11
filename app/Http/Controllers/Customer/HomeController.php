<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;

class HomeController extends Controller
{
    /**
     * Landing Page - Menampilkan produk untuk semua pengguna
     */
    public function index()
    {
        $products = Product::with('category')->get();
        return view('landing.index', compact('products'));
    }

    /**
     * Customer Dashboard - Setelah login
     */
    public function dashboard()
    {
        return view('customer.home');
    }
}

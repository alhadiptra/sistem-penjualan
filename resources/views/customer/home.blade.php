@extends('layouts.app')

@section('title', 'Dashboard Customer')

@push('styles')
<style>
    /* ===== HERO WELCOME ===== */
    .welcome-section {
        background: linear-gradient(135deg, #fef6f9 0%, #fff0f5 100%);
        padding: 60px 0 40px;
        border-radius: 0 0 40px 40px;
        position: relative;
        overflow: hidden;
    }
    .welcome-section::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(255, 182, 193, 0.2) 0%, transparent 70%);
        border-radius: 50%;
        z-index: 0;
    }
    .welcome-section .container {
        position: relative;
        z-index: 1;
    }
    .welcome-title {
        font-weight: 700;
        font-size: 36px;
        color: #2d1b2e;
    }
    .welcome-title span {
        background: linear-gradient(135deg, #ff69b4, #d63384);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    .welcome-subtitle {
        color: #888;
        font-size: 16px;
        margin-top: 5px;
    }
    .welcome-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: linear-gradient(135deg, #ff69b4, #d63384);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        color: white;
        box-shadow: 0 8px 30px rgba(214, 51, 132, 0.25);
    }

    /* ===== MENU CARD ===== */
    .menu-card {
        border-radius: 20px;
        border: 1px solid #f0e0e6;
        box-shadow: 0 5px 30px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
        padding: 30px 25px;
        text-align: center;
        background: white;
        height: 100%;
        position: relative;
        overflow: hidden;
    }
    .menu-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(135deg, #ff69b4, #d63384);
        opacity: 0;
        transition: all 0.3s ease;
    }
    .menu-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 50px rgba(255, 105, 180, 0.15);
        border-color: #ffb6c9;
    }
    .menu-card:hover::before {
        opacity: 1;
    }
    .menu-card .icon-wrapper {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 30px;
        margin: 0 auto 15px;
        transition: all 0.3s ease;
    }
    .menu-card:hover .icon-wrapper {
        transform: scale(1.05);
    }
    .icon-wrapper-pink { background: #fff0f5; color: #d63384; }
    .icon-wrapper-blue { background: #e8f4fd; color: #0c63e4; }
    .icon-wrapper-green { background: #e6f9e6; color: #198754; }
    .menu-card h5 {
        font-weight: 600;
        color: #2d1b2e;
        margin-bottom: 8px;
    }
    .menu-card p {
        color: #888;
        font-size: 14px;
        margin-bottom: 18px;
    }
    .btn-menu {
        border-radius: 50px;
        padding: 8px 28px;
        font-weight: 500;
        font-size: 14px;
        transition: all 0.3s ease;
        border: 2px solid #ff69b4;
        color: #d63384;
        background: transparent;
        text-decoration: none;
        display: inline-block;
    }
    .btn-menu:hover {
        background: linear-gradient(135deg, #ff69b4, #d63384);
        color: white;
        border-color: transparent;
        transform: scale(1.03);
        box-shadow: 0 5px 20px rgba(214, 51, 132, 0.3);
    }
    .btn-menu i {
        margin-right: 6px;
    }

    /* ===== QUOTE / PROMO ===== */
    .quote-box {
        background: linear-gradient(135deg, #fef6f9, #fff0f5);
        border: 1px solid #ffb6c9;
        border-radius: 16px;
        padding: 25px 30px;
        text-align: center;
    }
    .quote-box i {
        color: #d63384;
        font-size: 24px;
    }
    .quote-box p {
        font-size: 16px;
        color: #666;
        font-style: italic;
        margin-bottom: 5px;
    }
    .quote-box small {
        color: #999;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
        .welcome-title {
            font-size: 26px;
        }
        .welcome-avatar {
            width: 60px;
            height: 60px;
            font-size: 24px;
        }
        .menu-card {
            padding: 20px;
        }
    }
</style>
@endpush

@section('content')
<div class="container-fluid p-0">

    <!-- ===== WELCOME SECTION ===== -->
    <section class="welcome-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="welcome-title">
                        Halo, <span>{{ auth()->user()->name }}</span>
                    </h1>
                    <p class="welcome-subtitle">
                        Selamat datang di dashboard customer MochiHaanShop.
                        Temukan mochi favorit Anda dan pesan sekarang!
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== MENU CUSTOMER ===== -->
    <section class="py-5">
        <div class="container">
            <div class="row g-4">
                <!-- Produk -->
                <div class="col-md-4">
                    <div class="menu-card">
                        <div class="icon-wrapper icon-wrapper-pink">
                            <i class="fas fa-store"></i>
                        </div>
                        <h5>Lihat Produk</h5>
                        <p>Jelajahi berbagai macam mochi premium favorit Anda</p>
                        <a href="{{ route('landing') }}" class="btn-menu">
                            <i class="fas fa-arrow-right"></i> Kunjungi
                        </a>
                    </div>
                </div>

                <!-- Keranjang -->
                <div class="col-md-4">
                    <div class="menu-card">
                        <div class="icon-wrapper icon-wrapper-blue">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <h5>Keranjang Belanja</h5>
                        <p>Lihat dan kelola pesanan Anda sebelum checkout</p>
                        <a href="{{ route('customer.cart') }}" class="btn-menu">
                            <i class="fas fa-arrow-right"></i> Keranjang
                        </a>
                    </div>
                </div>

                <!-- Riwayat -->
                <div class="col-md-4">
                    <div class="menu-card">
                        <div class="icon-wrapper icon-wrapper-green">
                            <i class="fas fa-history"></i>
                        </div>
                        <h5>Riwayat Pesanan</h5>
                        <p>Cek status pesanan dan lihat detail transaksi Anda</p>
                        <a href="{{ route('customer.orders') }}" class="btn-menu">
                            <i class="fas fa-arrow-right"></i> Riwayat
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== QUOTE / PROMO ===== -->
    <section class="py-3 pb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="quote-box">
                        <i class="fas fa-quote-left"></i>
                        <p class="mb-0">
                            "Mochi terbaik untuk hari yang lebih manis. Pesan sekarang dan
                            rasakan kelembutannya!"
                        </p>
                        <small>- MochiHaanShop</small>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

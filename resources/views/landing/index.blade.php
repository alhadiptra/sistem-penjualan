@extends('layouts.app')

@section('title', 'MochiHaanShop - Mochi Premium')

@push('styles')
<style>
    /* ===== HERO SECTION ===== */
    .hero-section {
        padding: 120px 0 80px;
        background: linear-gradient(180deg, #fef6f9 0%, #fff0f5 100%);
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    .hero-section::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 600px;
        height: 600px;
        background: radial-gradient(circle, rgba(255, 182, 193, 0.2) 0%, transparent 70%);
        border-radius: 50%;
        z-index: 0;
    }
    .hero-section .container {
        position: relative;
        z-index: 1;
    }
    .hero-title {
        font-weight: 700;
        font-size: 52px;
        color: #2d1b2e;
        line-height: 1.2;
    }
    .hero-title span {
        background: linear-gradient(135deg, #ff69b4, #d63384);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    .hero-subtitle {
        font-size: 18px;
        color: #666;
        max-width: 600px;
        margin: 20px auto 0;
        line-height: 1.8;
    }
    .hero-image {
        max-width: 350px;
        width: 100%;
        animation: float 3s ease-in-out infinite;
    }
    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-15px); }
    }

    /* ===== PRODUCT CARD ===== */
    .product-card {
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 5px 30px rgba(0,0,0,0.06);
        transition: all 0.3s ease;
        background: white;
        border: 1px solid #fff0f5;
        margin-bottom: 30px;
    }
    .product-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 50px rgba(255, 105, 180, 0.15);
    }
    .product-card .product-image {
        height: 220px;
        background: #fef6f9;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 70px;
        overflow: hidden;
    }
    .product-card .product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .product-card .product-body {
        padding: 20px;
    }
    .product-card .product-name {
        font-weight: 600;
        font-size: 18px;
        color: #2d1b2e;
        margin-bottom: 4px;
    }
    .product-card .product-price {
        color: #d63384;
        font-weight: 700;
        font-size: 20px;
    }
    .product-card .product-stock {
        color: #888;
        font-size: 14px;
    }
    .product-card .btn-add-cart {
        background: linear-gradient(135deg, #ff69b4, #d63384);
        color: white;
        border: none;
        border-radius: 50px;
        padding: 10px;
        font-weight: 500;
        transition: all 0.3s ease;
        width: 100%;
        margin-top: 10px;
    }
    .product-card .btn-add-cart:hover {
        transform: scale(1.02);
        box-shadow: 0 5px 20px rgba(214, 51, 132, 0.3);
        color: white;
    }
    .product-card .btn-add-cart:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    /* ===== PRODUCT DESCRIPTION ===== */
    .product-description {
        font-size: 13px;
        color: #666;
        margin: 5px 0 10px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        min-height: 38px;
        line-height: 1.5;
    }

    /* ===== BADGE ===== */
    .badge-premium {
        background: linear-gradient(135deg, #ffd700, #ff8c00);
        color: white;
        padding: 4px 12px;
        border-radius: 50px;
        font-size: 11px;
        font-weight: 600;
    }
    .badge-reguler {
        background: #e0e0e0;
        color: #555;
        padding: 4px 12px;
        border-radius: 50px;
        font-size: 11px;
        font-weight: 600;
    }
    .badge-stok-aman {
        background: #d4edda;
        color: #155724;
        padding: 4px 12px;
        border-radius: 50px;
        font-size: 11px;
        font-weight: 600;
    }
    .badge-stok-habis {
        background: #f8d7da;
        color: #721c24;
        padding: 4px 12px;
        border-radius: 50px;
        font-size: 11px;
        font-weight: 600;
    }

    /* ===== SECTION TITLE ===== */
    .section-title {
        font-weight: 700;
        font-size: 36px;
        color: #2d1b2e;
        text-align: center;
        margin-bottom: 10px;
    }
    .section-title span {
        background: linear-gradient(135deg, #ff69b4, #d63384);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    .section-subtitle {
        text-align: center;
        color: #888;
        margin-bottom: 40px;
        font-size: 16px;
    }

    /* ===== CART ICON ===== */
    .cart-icon {
        position: relative;
        color: #d63384;
        font-size: 22px;
        transition: all 0.3s ease;
    }
    .cart-icon:hover {
        transform: scale(1.1);
        color: #ff69b4;
    }
    .cart-icon .badge-count {
        position: absolute;
        top: -8px;
        right: -10px;
        background: #dc3545;
        color: white;
        font-size: 10px;
        border-radius: 50%;
        padding: 2px 7px;
        font-weight: 600;
        min-width: 18px;
        text-align: center;
    }

    /* ===== FOOTER ===== */
    .footer {
        background: #2d1b2e;
        padding: 50px 0 30px;
        color: #ccc;
    }
    .footer .footer-brand {
        font-weight: 700;
        font-size: 24px;
        color: #ff69b4;
    }
    .footer .footer-brand img {
        border-radius: 10px;
        margin-right: 10px;
    }
    .footer h5 {
        color: white;
        font-weight: 600;
        margin-bottom: 20px;
    }
    .footer .info-item {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 12px;
        font-size: 14px;
    }
    .footer .info-item i {
        color: #ff69b4;
        width: 20px;
        text-align: center;
        font-size: 16px;
    }
    .footer .info-item a {
        color: #ccc;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    .footer .info-item a:hover {
        color: #ff69b4;
    }
    .footer .social-icons a {
        display: inline-block;
        width: 40px;
        height: 40px;
        line-height: 40px;
        text-align: center;
        border-radius: 50%;
        background: rgba(255,255,255,0.1);
        margin-right: 10px;
        transition: all 0.3s ease;
        font-size: 18px;
        color: #ccc;
    }
    .footer .social-icons a:hover {
        background: #ff69b4;
        color: white;
        transform: translateY(-3px);
    }
    .footer-bottom {
        border-top: 1px solid rgba(255,255,255,0.1);
        padding-top: 20px;
        margin-top: 30px;
        text-align: center;
        font-size: 14px;
        color: #888;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
        .hero-title {
            font-size: 32px;
        }
        .hero-section {
            padding: 100px 0 40px;
        }
        .section-title {
            font-size: 28px;
        }
        .product-card .product-image {
            height: 180px;
        }
        .footer {
            text-align: center;
        }
        .footer .info-item {
            justify-content: center;
        }
        .footer .social-icons a {
            margin: 0 5px;
        }
    }
</style>
@endpush

@section('content')
<!-- ===== NAVBAR ===== -->
<nav class="navbar navbar-expand-lg navbar-custom fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('landing') }}">
            <img src="{{ asset('images/logo-mochi.png') }}" alt="MochiHaanShop" height="40" style="border-radius: 10px;">
            <span class="ms-2">MochiHaanShop</span>
        </a>
        <div class="d-flex align-items-center gap-2">
            <!-- Cart Icon untuk Customer -->
            @auth
                @if(auth()->user()->role == 'customer')
                    @php
                        $cartCount = App\Models\Cart::where('user_id', auth()->id())->sum('qty');
                    @endphp
                    <a href="{{ route('customer.cart') }}" class="cart-icon me-2" title="Keranjang Belanja">
                        <i class="fas fa-shopping-cart"></i>
                        @if($cartCount > 0)
                            <span class="badge-count">{{ $cartCount }}</span>
                        @endif
                    </a>
                @endif
            @endauth

            @guest
                <a href="{{ route('login') }}" class="btn btn-outline-pink btn-sm">Login</a>
                <a href="{{ route('register') }}" class="btn btn-pink btn-sm">Daftar</a>
            @else
                <span class="text-muted me-2">{{ auth()->user()->name }}</span>
                @if(auth()->user()->role == 'owner')
                    <a href="{{ route('owner.dashboard') }}" class="btn btn-outline-pink btn-sm">Dashboard</a>
                @elseif(auth()->user()->role == 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-pink btn-sm">Dashboard</a>
                @else
                    <a href="{{ route('customer.home') }}" class="btn btn-outline-pink btn-sm">Dashboard</a>
                @endif
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-pink btn-sm">
                        <i class="fas fa-sign-out-alt me-1"></i> Logout
                    </button>
                </form>
            @endguest
        </div>
    </div>
</nav>

<!-- ===== HERO SECTION ===== -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7 text-start">
                <h1 class="hero-title">
                    Nikmati Kelembutan <br>
                    <span>Mochi Premium</span> Setiap Hari
                </h1>
                <p class="hero-subtitle text-start">
                    Mochi buatan tangan dengan cinta, tersedia dalam berbagai rasa
                    yang akan memanjakan lidah Anda. Pesan sekarang dan rasakan
                    kelembutannya!
                </p>
                <div class="mt-4">
                    <a href="#produk" class="btn btn-pink">
                        <i class="fas fa-shopping-bag me-2"></i> Lihat Produk
                    </a>
                </div>
            </div>
            <div class="col-lg-5 text-center">
                <img src="{{ asset('images/logo-mochi.png') }}" alt="MochiHaanShop" class="hero-image">
            </div>
        </div>
    </div>
</section>

<!-- ===== PRODUCTS SECTION ===== -->
<section class="py-5" id="produk">
    <div class="container">
        <h2 class="section-title"> Produk <span>Kami</span></h2>
        <p class="section-subtitle">Pilihan mochi terbaik untuk Anda</p>

        <div class="row">
            @forelse($products as $product)
                <div class="col-md-4">
                    <div class="product-card">
                        <div class="product-image">
                            @if($product->gambar)
                                <img src="{{ asset($product->gambar) }}" alt="{{ $product->nama_produk }}">
                            @endif
                        </div>
                        <div class="product-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <h5 class="product-name">{{ $product->nama_produk }}</h5>
                                @if($product->category->nama_kategori == 'Premium')
                                    <span class="badge-premium">⭐ Premium</span>
                                @else
                                    <span class="badge-reguler">📦 Reguler</span>
                                @endif
                            </div>
                            <p class="text-muted small">{{ $product->category->nama_kategori }}</p>

                            <!-- ✅ DESKRIPSI PRODUK -->
                            @if($product->deskripsi)
                                <p class="product-description">
                                    {{ Str::limit($product->deskripsi, 60) }}
                                </p>
                            @endif

                            <div class="d-flex justify-content-between align-items-center">
                                <span class="product-price">Rp {{ number_format($product->harga, 0, ',', '.') }}</span>
                                <span class="product-stock">
                                    @if($product->stok > 0)
                                        <span class="badge-stok-aman"><i class="fas fa-box"></i> {{ $product->stok }}</span>
                                    @else
                                        <span class="badge-stok-habis">Habis</span>
                                    @endif
                                </span>
                            </div>
                            @auth
                                @if(auth()->user()->role == 'customer')
                                    <form action="{{ route('customer.cart.add') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <button type="submit" class="btn-add-cart" {{ $product->stok <= 0 ? 'disabled' : '' }}>
                                            <i class="fas fa-cart-plus me-1"></i> Tambah ke Keranjang
                                        </button>
                                    </form>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="btn-add-cart text-center d-block text-decoration-none">
                                    <i class="fas fa-cart-plus me-1"></i> Login untuk Belanja
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                    <p class="text-muted">Belum ada produk tersedia.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- ===== FOOTER ===== -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="footer-brand">
                    <img src="{{ asset('images/logo-mochi.png') }}" alt="MochiHaanShop" height="35" style="border-radius: 8px;">
                    MochiHaanShop
                </div>
                <p class="mt-3" style="font-size: 14px; line-height: 1.8;">
                    Menyajikan mochi terbaik dengan cinta sejak 2024.
                    Kami berkomitmen memberikan pengalaman kuliner yang tak terlupakan.
                </p>
            </div>
            <div class="col-md-4">
                <h5><i class="fas fa-address-card me-2"></i> Kontak</h5>
                <div class="info-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>Jl. Rimbo Kaluang No.26, Kec. Padang Barat, Kota Padang</span>
                </div>
                <div class="info-item">
                    <i class="fas fa-phone"></i>
                    <a>0899-5652-308</a>
                </div>
                <div class="info-item">
                    <i class="fas fa-clock"></i>
                    <span>Setiap Hari: 09.00 - 20.00</span>
                </div>
            </div>
            <div class="col-md-4">
                <h5><i class="fas fa-share-alt me-2"></i> Ikuti Kami</h5>
                <div class="social-icons mt-2">
                    <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="https://wa.me/628995652308" target="_blank"><i class="fab fa-whatsapp"></i></a>
                    <a href="https://www.tiktok.com/@mochi.hann" target="_blank"><i class="fab fa-tiktok"></i></a>
                </div>
                <p class="mt-3" style="font-size: 14px; color: #888;">
                    <i class="fas fa-store me-1" style="color: #ff69b4;"></i>
                    Kunjungi toko kami untuk pengalaman langsung!
                </p>
            </div>
        </div>
        <div class="footer-bottom">
            <p class="mb-0">&copy; 2026 <strong>MochiHaanShop</strong>. All rights reserved. Made with <i class="fas fa-heart" style="color: #ff69b4;"></i> in Padang.</p>
        </div>
    </div>
</footer>
@endsection

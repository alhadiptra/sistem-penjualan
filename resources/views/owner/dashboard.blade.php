@extends('layouts.app')

@section('title', 'Dashboard Owner')

@push('styles')
<style>
.sidebar {
    background: white;
    min-height: calc(100vh - 70px);
    border-right: 1px solid #f0e0e6;
    padding: 20px 0;
}
.sidebar .nav-link {
    color: #555;
    padding: 12px 25px;
    border-radius: 12px;
    margin: 4px 10px;
    transition: all 0.3s ease;
    font-weight: 500;
}
.sidebar .nav-link:hover { background: #fff0f5; color: #d63384; }
.sidebar .nav-link.active { background: linear-gradient(135deg, #ffd700, #ff8c00); color: white; }
.sidebar .nav-link i { width: 22px; margin-right: 10px; }
.stat-card {
    background: white;
    border-radius: 16px;
    padding: 25px;
    border: 1px solid #f0e0e6;
    box-shadow: 0 2px 10px rgba(0,0,0,0.04);
    transition: all 0.3s ease;
}
.stat-card:hover { transform: translateY(-3px); box-shadow: 0 8px 25px rgba(0,0,0,0.06); }
.stat-card .icon { font-size: 32px; width: 60px; height: 60px; border-radius: 14px; display: flex; align-items: center; justify-content: center; }
.stat-card .icon-gold { background: #fff8e1; color: #f57c00; }
.stat-card .icon-pink { background: #fff0f5; color: #d63384; }
.stat-card .icon-blue { background: #e8f4fd; color: #0c63e4; }
.stat-card .icon-green { background: #e6f9e6; color: #198754; }
.stat-card .icon-orange { background: #fff3e6; color: #e46c0c; }
.stat-card .number { font-size: 28px; font-weight: 700; color: #2d1b2e; }
.stat-card .label { color: #888; font-size: 14px; }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 sidebar">
            <nav class="nav flex-column">
                <a class="nav-link active" href="{{ route('owner.dashboard') }}"><i class="fas fa-chart-pie"></i> Dashboard</a>
                <a class="nav-link" href="{{ route('owner.admins.index') }}"><i class="fas fa-user-cog"></i> Kelola Admin</a>
                <a class="nav-link" href="{{ route('owner.products.index') }}"><i class="fas fa-box"></i> Kelola Produk</a>
                <a class="nav-link" href="{{ route('owner.reports.daily') }}"><i class="fas fa-file-invoice"></i> Laporan Harian</a>
                <a class="nav-link" href="{{ route('owner.reports.monthly') }}"><i class="fas fa-file-invoice"></i> Laporan Bulanan</a>
            </nav>
        </div>

        <div class="col-md-10 p-4">
            <h4 class="fw-bold">👑 Dashboard Owner</h4>
            <p class="text-muted">Selamat datang, {{ auth()->user()->name }}</p>

            <div class="row g-4">
                <div class="col-md-3">
                    <div class="stat-card d-flex align-items-center">
                        <div class="icon icon-pink me-3"><i class="fas fa-box"></i></div>
                        <div><div class="number">{{ $totalProducts ?? 0 }}</div><div class="label">Total Produk</div></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card d-flex align-items-center">
                        <div class="icon icon-blue me-3"><i class="fas fa-shopping-bag"></i></div>
                        <div><div class="number">{{ $totalOrders ?? 0 }}</div><div class="label">Total Pesanan</div></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card d-flex align-items-center">
                        <div class="icon icon-green me-3"><i class="fas fa-users"></i></div>
                        <div><div class="number">{{ $totalCustomers ?? 0 }}</div><div class="label">Pelanggan</div></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card d-flex align-items-center">
                        <div class="icon icon-gold me-3"><i class="fas fa-money-bill"></i></div>
                        <div><div class="number">Rp {{ number_format($totalRevenue ?? 0, 0, ',', '.') }}</div><div class="label">Total Penjualan</div></div>
                    </div>
                </div>
            </div>

            <div class="row g-4 mt-2">
                <div class="col-md-4">
                    <div class="stat-card d-flex align-items-center">
                        <div class="icon icon-orange me-3"><i class="fas fa-clock"></i></div>
                        <div><div class="number">{{ $pendingOrders ?? 0 }}</div><div class="label">Pesanan Pending</div></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card d-flex align-items-center">
                        <div class="icon icon-blue me-3"><i class="fas fa-user-cog"></i></div>
                        <div><div class="number">{{ $totalAdmins ?? 0 }}</div><div class="label">Total Admin</div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

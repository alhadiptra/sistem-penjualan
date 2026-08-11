@extends('layouts.app')

@section('title', 'Detail Pelanggan')

@push('styles')
<style>
    .btn-pink {
        background: linear-gradient(135deg, #ff69b4, #d63384);
        color: white;
        border: none;
        border-radius: 50px;
        padding: 8px 20px;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    .btn-pink:hover {
        transform: scale(1.03);
        box-shadow: 0 5px 20px rgba(214, 51, 132, 0.3);
        color: white;
    }
    .btn-outline-pink {
        border: 2px solid #ff69b4;
        color: #d63384;
        border-radius: 50px;
        padding: 6px 16px;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    .btn-outline-pink:hover {
        background: #ff69b4;
        color: white;
    }
    .badge-customer {
        background: #28a745;
        color: white;
        padding: 4px 12px;
        border-radius: 50px;
        font-size: 11px;
        font-weight: 600;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 sidebar">
            <nav class="nav flex-column">
                <a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fas fa-chart-pie"></i> Dashboard</a>
                <a class="nav-link" href="{{ route('admin.categories.index') }}"><i class="fas fa-tags"></i> Kategori</a>
                <a class="nav-link" href="{{ route('admin.products.index') }}"><i class="fas fa-box"></i> Produk</a>
                <a class="nav-link" href="{{ route('admin.orders.index') }}"><i class="fas fa-shopping-bag"></i> Pesanan</a>
                <a class="nav-link active" href="{{ route('admin.customers.index') }}"><i class="fas fa-users"></i> Pelanggan</a>
            </nav>
        </div>

        <div class="col-md-10 p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold">👤 Detail Pelanggan</h4>
                <a href="{{ route('admin.customers.index') }}" class="btn btn-outline-pink">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Nama Lengkap</strong><br>{{ $customer->name }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Username</strong><br>{{ $customer->username }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Role</strong><br><span class="badge-customer">🛒 Customer</span></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Bergabung Sejak</strong><br>{{ $customer->created_at->format('d F Y H:i') }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p><strong>Total Pesanan</strong><br>{{ $customer->orders->count() }} pesanan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

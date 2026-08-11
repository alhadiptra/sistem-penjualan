@extends('layouts.app')

@section('title', 'Data Pelanggan')

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
    .table-pink th {
        background: #fff0f5;
        color: #d63384;
        font-weight: 600;
    }
    .table-pink tbody tr:hover {
        background: #fef6f9;
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
            <h4 class="fw-bold">👥 Data Pelanggan</h4>

            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-pink table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Bergabung</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($customers as $key => $customer)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td><strong>{{ $customer->name }}</strong></td>
                                        <td>{{ $customer->username }}</td>
                                        <td>{{ $customer->created_at->format('d/m/Y') }}</td>
                                        <td>
                                            <a href="{{ route('admin.customers.show', $customer) }}" class="btn btn-outline-pink btn-sm">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4 text-muted">
                                            <i class="fas fa-users-slash fa-2x d-block mb-2"></i>
                                            Belum ada pelanggan terdaftar.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

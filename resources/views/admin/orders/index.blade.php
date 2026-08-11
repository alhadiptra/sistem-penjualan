@extends('layouts.app')

@section('title', 'Data Pesanan')

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
    .badge-menunggu { background: #ffc107; color: #212529; padding: 4px 12px; border-radius: 50px; font-size: 11px; font-weight: 600; }
    .badge-diproses { background: #17a2b8; color: white; padding: 4px 12px; border-radius: 50px; font-size: 11px; font-weight: 600; }
    .badge-siap { background: #6f42c1; color: white; padding: 4px 12px; border-radius: 50px; font-size: 11px; font-weight: 600; }
    .badge-selesai { background: #28a745; color: white; padding: 4px 12px; border-radius: 50px; font-size: 11px; font-weight: 600; }
    .badge-batal { background: #dc3545; color: white; padding: 4px 12px; border-radius: 50px; font-size: 11px; font-weight: 600; }
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
                <a class="nav-link active" href="{{ route('admin.orders.index') }}"><i class="fas fa-shopping-bag"></i> Pesanan</a>
                <a class="nav-link" href="{{ route('admin.customers.index') }}"><i class="fas fa-users"></i> Pelanggan</a>
            </nav>
        </div>

        <div class="col-md-10 p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold">🛒 Data Pesanan</h4>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-pink table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>No. Order</th>
                                    <th>Pelanggan</th>
                                    <th>No HP</th>
                                    <th>Tanggal</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orders as $key => $order)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td><strong>{{ $order->no_order ?? '#' . $order->id }}</strong></td>
                                        <td>{{ $order->user->name }}</td>
                                        <td>{{ $order->no_hp ?? '-' }}</td>
                                        <td>{{ \Carbon\Carbon::parse($order->tanggal_order)->format('d/m/Y') }}</td>
                                        <td>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                                        <td>
                                            @if($order->status == 'menunggu_pembayaran')
                                                <span class="badge-menunggu">⏳ Menunggu Pembayaran</span>
                                            @elseif($order->status == 'diproses')
                                                <span class="badge-diproses">🔄 Diproses</span>
                                            @elseif($order->status == 'siap_diantar')
                                                <span class="badge-siap">📦 Siap Diantar</span>
                                            @elseif($order->status == 'selesai')
                                                <span class="badge-selesai">✅ Selesai</span>
                                            @else
                                                <span class="badge-batal">❌ Batal</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-outline-pink btn-sm">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-4 text-muted">
                                            <i class="fas fa-inbox fa-2x d-block mb-2"></i>
                                            Belum ada pesanan.
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

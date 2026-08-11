@extends('layouts.app')

@section('title', 'Detail Pesanan')

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
                <h4 class="fw-bold">📋 Detail Pesanan #{{ $order->id }}</h4>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-pink">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="card shadow-sm mb-3">
                        <div class="card-body">
                            <h6 class="fw-bold">Informasi Pelanggan</h6>
                            <p><strong>Nama:</strong> {{ $order->user->name }}</p>
                            <p><strong>Username:</strong> {{ $order->user->username }}</p>
                            <p><strong>No HP:</strong> {{ $order->no_hp ?? '-' }}</p>
                            <p><strong>Tanggal Order:</strong> {{ \Carbon\Carbon::parse($order->tanggal_order)->format('d/m/Y H:i') }}</p>
                            <p><strong>Metode Pembayaran:</strong> {{ $order->metode_pembayaran }}</p>
                            <p><strong>Jenis Pesanan:</strong> {{ $order->jenis_pesanan == 'diantar' ? '🚗 Diantar' : '🏪 Ambil di Toko' }}</p>
                            <p><strong>Alamat:</strong> {{ $order->alamat ?? 'Ambil di toko (takeaway)' }}</p>
                            @if($order->catatan)
                                <p><strong>Catatan:</strong> {{ $order->catatan }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card shadow-sm mb-3">
                        <div class="card-body">
                            <h6 class="fw-bold">Update Status</h6>
                            <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label class="form-label">Status Saat Ini</label>
                                    <select name="status" class="form-select">
                                        <option value="menunggu_pembayaran" {{ $order->status == 'menunggu_pembayaran' ? 'selected' : '' }}>⏳ Menunggu Pembayaran</option>
                                        <option value="diproses" {{ $order->status == 'diproses' ? 'selected' : '' }}>🔄 Diproses</option>
                                        <option value="siap_diantar" {{ $order->status == 'siap_diantar' ? 'selected' : '' }}>📦 Siap Diantar</option>
                                        <option value="selesai" {{ $order->status == 'selesai' ? 'selected' : '' }}>✅ Selesai</option>
                                        <option value="batal" {{ $order->status == 'batal' ? 'selected' : '' }}>❌ Batal</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-pink btn-sm">Update Status</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">
                    <h6 class="fw-bold">Detail Produk</h6>
                    <div class="table-responsive">
                        <table class="table table-pink table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Produk</th>
                                    <th>Harga</th>
                                    <th>Qty</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->orderDetails as $key => $detail)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $detail->product->nama_produk }}</td>
                                        <td>Rp {{ number_format($detail->harga, 0, ',', '.') }}</td>
                                        <td>{{ $detail->qty }}</td>
                                        <td>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="4" class="text-end">Total</th>
                                    <th>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

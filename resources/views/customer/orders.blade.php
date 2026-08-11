@extends('layouts.app')

@section('title', 'Riwayat Pesanan')

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
    .badge-menunggu { background: #ffc107; color: #212529; padding: 4px 12px; border-radius: 50px; font-size: 11px; font-weight: 600; }
    .badge-diproses { background: #17a2b8; color: white; padding: 4px 12px; border-radius: 50px; font-size: 11px; font-weight: 600; }
    .badge-siap { background: #6f42c1; color: white; padding: 4px 12px; border-radius: 50px; font-size: 11px; font-weight: 600; }
    .badge-selesai { background: #28a745; color: white; padding: 4px 12px; border-radius: 50px; font-size: 11px; font-weight: 600; }
    .badge-batal { background: #dc3545; color: white; padding: 4px 12px; border-radius: 50px; font-size: 11px; font-weight: 600; }
</style>
@endpush

@section('content')
<div class="container py-5">
    <h2 class="fw-bold mb-4">📜 Riwayat Pesanan</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($orders->isEmpty())
        <div class="text-center py-5">
            <i class="fas fa-receipt fa-3x text-muted mb-3"></i>
            <p class="text-muted">Belum ada pesanan.</p>
            <a href="{{ route('landing') }}" class="btn btn-pink">Belanja Sekarang</a>
        </div>
    @else
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-pink table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>No. Order</th>
                                <th>Tanggal</th>
                                <th>Total</th>
                                <th>Metode</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $key => $order)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td><strong>{{ $order->no_order ?? '#' . $order->id }}</strong></td>
                                    <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y H:i') }}</td>
                                    <td>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                                    <td>{{ ucfirst($order->metode_pembayaran) }}</td>
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
                                        <a href="{{ route('customer.orders.show', $order) }}" class="btn btn-outline-pink btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection

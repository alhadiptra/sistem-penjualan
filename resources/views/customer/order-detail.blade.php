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
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">📋 Detail Pesanan {{ $order->no_order ? '#'. $order->no_order : '#'. $order->id }}</h2>
        <a href="{{ route('customer.orders') }}" class="btn btn-outline-pink">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <div class="card shadow-sm mb-3">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <p><strong>No. Order</strong><br>{{ $order->no_order ?? '#' . $order->id }}</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Tanggal</strong><br>{{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y H:i') }}</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Total</strong><br>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <p><strong>Status</strong><br>
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
                    </p>
                </div>
                <div class="col-md-4">
                    <p><strong>Metode Pembayaran</strong><br>{{ ucfirst($order->metode_pembayaran) }}</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Jenis Pesanan</strong><br>{{ $order->jenis_pesanan == 'diantar' ? '🚗 Diantar' : '🏪 Ambil di Toko' }}</p>
                </div>
            </div>
            @if($order->alamat || $order->no_hp)
            <div class="row">
                @if($order->no_hp)
                <div class="col-md-4">
                    <p><strong>No HP</strong><br>{{ $order->no_hp ?? '-' }}</p>
                </div>
                @endif
                @if($order->alamat)
                <div class="col-md-8">
                    <p><strong>Alamat</strong><br>{{ $order->alamat ?? 'Ambil di toko (takeaway)' }}</p>
                </div>
                @endif
            </div>
            @endif
            @if($order->catatan)
            <div class="row">
                <div class="col-12">
                    <p><strong>Catatan</strong><br>{{ $order->catatan }}</p>
                </div>
            </div>
            @endif
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
                                <td><strong>{{ $detail->product->nama_produk }}</strong></td>
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
@endsection

@extends('layouts.app')

@section('title', 'Keranjang Belanja')

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
</style>
@endpush

@section('content')
<div class="container py-5">
    <h2 class="fw-bold mb-4">🛒 Keranjang Belanja</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($carts->isEmpty())
        <div class="text-center py-5">
            <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
            <p class="text-muted">Keranjang belanja kosong.</p>
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
                                <th>Produk</th>
                                <th>Harga</th>
                                <th>Qty</th>
                                <th>Subtotal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($carts as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td><strong>{{ $item->product->nama_produk }}</strong></td>
                                    <td>Rp {{ number_format($item->product->harga, 0, ',', '.') }}</td>
                                    <td>
                                        <form action="{{ route('customer.cart.update', $item) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <input type="number" name="qty" value="{{ $item->qty }}" min="1" style="width:60px; border:1px solid #ddd; border-radius:8px; padding:5px;">
                                            <button type="submit" class="btn btn-outline-pink btn-sm"><i class="fas fa-sync"></i></button>
                                        </form>
                                    </td>
                                    <td>Rp {{ number_format($item->product->harga * $item->qty, 0, ',', '.') }}</td>
                                    <td>
                                        <form action="{{ route('customer.cart.remove', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus dari keranjang?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4" class="text-end">Total</th>
                                <th colspan="2">Rp {{ number_format($total, 0, ',', '.') }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="{{ route('landing') }}" class="btn btn-outline-pink">Lanjut Belanja</a>
                    <a href="{{ route('customer.checkout') }}" class="btn btn-pink">Checkout</a>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection

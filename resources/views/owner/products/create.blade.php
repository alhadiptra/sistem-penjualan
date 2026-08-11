@extends('layouts.app')

@section('title', 'Tambah Produk - Owner')

@push('styles')
<style>
    .btn-pink {
        background: linear-gradient(135deg, #ff69b4, #d63384);
        color: white;
        border: none;
        border-radius: 50px;
        padding: 10px 30px;
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
        padding: 10px 30px;
        font-weight: 500;
        transition: all 0.3s ease;
        background: transparent;
    }
    .btn-outline-pink:hover {
        background: #ff69b4;
        color: white;
    }
    .sidebar .nav-link.active {
        background: linear-gradient(135deg, #ffd700, #ff8c00);
        color: white;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 sidebar">
            <nav class="nav flex-column">
                <a class="nav-link" href="{{ route('owner.dashboard') }}"><i class="fas fa-chart-pie"></i> Dashboard</a>
                <a class="nav-link" href="{{ route('owner.admins.index') }}"><i class="fas fa-user-cog"></i> Kelola Admin</a>
                <a class="nav-link active" href="{{ route('owner.products.index') }}"><i class="fas fa-box"></i> Kelola Produk</a>
                <a class="nav-link" href="{{ route('owner.reports.daily') }}"><i class="fas fa-file-invoice"></i> Laporan Harian</a>
                <a class="nav-link" href="{{ route('owner.reports.monthly') }}"><i class="fas fa-file-invoice"></i> Laporan Bulanan</a>
            </nav>
        </div>

        <div class="col-md-10 p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold">➕ Tambah Produk</h4>
                <a href="{{ route('owner.products.index') }}" class="btn btn-outline-pink">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('owner.products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Nama Produk <span class="text-danger">*</span></label>
                                    <input type="text" name="nama_produk" class="form-control @error('nama_produk') is-invalid @enderror" placeholder="Contoh: Mochi Coklat Lumer" required>
                                    @error('nama_produk')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Kategori <span class="text-danger">*</span></label>
                                    <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                                        <option value="">Pilih Kategori</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->nama_kategori }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Harga <span class="text-danger">*</span></label>
                                    <input type="number" name="harga" class="form-control @error('harga') is-invalid @enderror" placeholder="15000" required>
                                    @error('harga')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Stok <span class="text-danger">*</span></label>
                                    <input type="number" name="stok" class="form-control @error('stok') is-invalid @enderror" placeholder="50" required>
                                    @error('stok')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="3" placeholder="Deskripsi produk (opsional)"></textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Gambar Produk</label>
                            <input type="file" name="gambar" class="form-control @error('gambar') is-invalid @enderror" accept="image/*">
                            <small class="text-muted">Format: JPG, PNG, GIF (Maks 2MB)</small>
                            @error('gambar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-pink">
                            <i class="fas fa-save me-1"></i> Simpan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

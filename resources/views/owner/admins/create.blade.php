@extends('layouts.app')

@section('title', 'Tambah Admin')

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
    .form-control.is-invalid {
        border-color: #dc3545;
        box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25);
    }
    .invalid-feedback {
        display: block;
        font-size: 0.875rem;
        color: #dc3545;
        margin-top: 5px;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 sidebar">
            <nav class="nav flex-column">
                <a class="nav-link" href="{{ route('owner.dashboard') }}"><i class="fas fa-chart-pie"></i> Dashboard</a>
                <a class="nav-link active" href="{{ route('owner.admins.index') }}"><i class="fas fa-user-cog"></i> Kelola Admin</a>
                <a class="nav-link" href="{{ route('owner.products.index') }}"><i class="fas fa-box"></i> Kelola Produk</a>
                <a class="nav-link" href="{{ route('owner.reports.daily') }}"><i class="fas fa-file-invoice"></i> Laporan Harian</a>
                <a class="nav-link" href="{{ route('owner.reports.monthly') }}"><i class="fas fa-file-invoice"></i> Laporan Bulanan</a>
            </nav>
        </div>

        <div class="col-md-10 p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold">➕ Tambah Admin</h4>
                <a href="{{ route('owner.admins.index') }}" class="btn btn-outline-pink">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('owner.admins.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   placeholder="Masukkan nama"
                                   value="{{ old('name') }}"
                                   required>
                            @error('name')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Username <span class="text-danger">*</span></label>
                            <input type="text" name="username"
                                   class="form-control @error('username') is-invalid @enderror"
                                   placeholder="Masukkan username"
                                   value="{{ old('username') }}"
                                   required>
                            @error('username')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Password <span class="text-danger">*</span></label>
                            <input type="password" name="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   placeholder="Minimal 6 karakter"
                                   required>
                            @error('password')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Konfirmasi Password <span class="text-danger">*</span></label>
                            <input type="password" name="password_confirmation"
                                   class="form-control"
                                   placeholder="Ulangi password"
                                   required>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-pink">
                                <i class="fas fa-save me-1"></i> Simpan
                            </button>
                            <a href="{{ route('owner.admins.index') }}" class="btn btn-outline-pink">
                                <i class="fas fa-times me-1"></i> Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

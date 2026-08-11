@extends('layouts.app')

@section('title', 'Data Kategori')

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
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 sidebar">
            <nav class="nav flex-column">
                <a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fas fa-chart-pie"></i> Dashboard</a>
                <a class="nav-link active" href="{{ route('admin.categories.index') }}"><i class="fas fa-tags"></i> Kategori</a>
                <a class="nav-link" href="{{ route('admin.products.index') }}"><i class="fas fa-box"></i> Produk</a>
                <a class="nav-link" href="{{ route('admin.orders.index') }}"><i class="fas fa-shopping-bag"></i> Pesanan</a>
                <a class="nav-link" href="{{ route('admin.customers.index') }}"><i class="fas fa-users"></i> Pelanggan</a>
            </nav>
        </div>

        <div class="col-md-10 p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold">📋 Data Kategori</h4>
                <a href="{{ route('admin.categories.create') }}" class="btn btn-pink">
                    <i class="fas fa-plus me-1"></i> Tambah Kategori
                </a>
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
                                    <th>Nama Kategori</th>
                                    <th>Deskripsi</th>
                                    <th>Dibuat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($categories as $key => $category)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td><strong>{{ $category->nama_kategori }}</strong></td>
                                        <td>{{ $category->deskripsi ?? '-' }}</td>
                                        <td>{{ $category->created_at->format('d/m/Y') }}</td>
                                        <td>
                                            <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-outline-pink btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button"
                                                    class="btn btn-outline-danger btn-sm"
                                                    onclick="confirmDelete('{{ route('admin.categories.destroy', $category) }}', '{{ $category->nama_kategori }}')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4 text-muted">
                                            <i class="fas fa-inbox fa-2x d-block mb-2"></i>
                                            Belum ada kategori. <a href="{{ route('admin.categories.create') }}">Tambah sekarang</a>
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

<script>
function confirmDelete(url, name) {
    Swal.fire({
        title: 'Yakin hapus kategori ini?',
        text: "Kategori '" + name + "' akan dihapus permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d63384',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            // Buat form dan submit
            var form = document.createElement('form');
            form.method = 'POST';
            form.action = url;
            form.innerHTML = '@csrf @method('DELETE')';
            document.body.appendChild(form);
            form.submit();
        }
    });
}
</script>
@endsection

@extends('layouts.app')

@section('title', 'Data Produk')

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
    .badge-premium {
        background: linear-gradient(135deg, #ffd700, #ff8c00);
        color: white;
        padding: 4px 12px;
        border-radius: 50px;
        font-size: 11px;
        font-weight: 600;
    }
    .badge-reguler {
        background: #e0e0e0;
        color: #555;
        padding: 4px 12px;
        border-radius: 50px;
        font-size: 11px;
        font-weight: 600;
    }
    .badge-stok {
        padding: 4px 12px;
        border-radius: 50px;
        font-size: 11px;
        font-weight: 600;
    }
    .badge-stok-aman { background: #d4edda; color: #155724; }
    .badge-stok-habis { background: #f8d7da; color: #721c24; }
    .badge-stok-sedikit { background: #fff3cd; color: #856404; }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 sidebar">
            <nav class="nav flex-column">
                <a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fas fa-chart-pie"></i> Dashboard</a>
                <a class="nav-link" href="{{ route('admin.categories.index') }}"><i class="fas fa-tags"></i> Kategori</a>
                <a class="nav-link active" href="{{ route('admin.products.index') }}"><i class="fas fa-box"></i> Produk</a>
                <a class="nav-link" href="{{ route('admin.orders.index') }}"><i class="fas fa-shopping-bag"></i> Pesanan</a>
                <a class="nav-link" href="{{ route('admin.customers.index') }}"><i class="fas fa-users"></i> Pelanggan</a>
            </nav>
        </div>

        <div class="col-md-10 p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold">📦 Data Produk</h4>
                <a href="{{ route('admin.products.create') }}" class="btn btn-pink">
                    <i class="fas fa-plus me-1"></i> Tambah Produk
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
                                    <th>Gambar</th>
                                    <th>Nama Produk</th>
                                    <th>Kategori</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($products as $key => $product)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            @if($product->gambar)
                                                <img src="{{ asset($product->gambar) }}" width="50" height="50" style="object-fit:cover; border-radius:8px;">
                                            @else
                                            @endif
                                        </td>
                                        <td><strong>{{ $product->nama_produk }}</strong></td>
                                        <td>
                                            @if($product->category->nama_kategori == 'Premium')
                                                <span class="badge-premium">⭐ Premium</span>
                                            @else
                                                <span class="badge-reguler">📦 Reguler</span>
                                            @endif
                                        </td>
                                        <td>Rp {{ number_format($product->harga, 0, ',', '.') }}</td>
                                        <td>
                                            @if($product->stok > 10)
                                                <span class="badge-stok badge-stok-aman">{{ $product->stok }} tersisa</span>
                                            @elseif($product->stok > 0)
                                                <span class="badge-stok badge-stok-sedikit">{{ $product->stok }} tersisa</span>
                                            @else
                                                <span class="badge-stok badge-stok-habis">Habis</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-outline-pink btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button"
                                                    class="btn btn-outline-danger btn-sm"
                                                    onclick="confirmDelete('{{ route('admin.products.destroy', $product) }}', '{{ $product->nama_produk }}')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-4 text-muted">
                                            <i class="fas fa-box-open fa-2x d-block mb-2"></i>
                                            Belum ada produk. <a href="{{ route('admin.products.create') }}">Tambah sekarang</a>
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

<script>
function confirmDelete(url, name) {
    Swal.fire({
        title: 'Yakin hapus produk ini?',
        text: "Produk '" + name + "' akan dihapus permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d63384',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
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

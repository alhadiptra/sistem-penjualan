@extends('layouts.app')

@section('title', 'Kelola Admin')

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
    .badge-admin {
        background: #0c63e4;
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
                <a class="nav-link" href="{{ route('owner.dashboard') }}"><i class="fas fa-chart-pie"></i> Dashboard</a>
                <a class="nav-link active" href="{{ route('owner.admins.index') }}"><i class="fas fa-user-cog"></i> Kelola Admin</a>
                <a class="nav-link" href="{{ route('owner.products.index') }}"><i class="fas fa-box"></i> Kelola Produk</a>
                <a class="nav-link" href="{{ route('owner.reports.daily') }}"><i class="fas fa-file-invoice"></i> Laporan Harian</a>
                <a class="nav-link" href="{{ route('owner.reports.monthly') }}"><i class="fas fa-file-invoice"></i> Laporan Bulanan</a>
            </nav>
        </div>

        <div class="col-md-10 p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold">🛡️ Kelola Admin</h4>
                <a href="{{ route('owner.admins.create') }}" class="btn btn-pink">
                    <i class="fas fa-plus me-1"></i> Tambah Admin
                </a>
            </div>

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
                                @forelse($admins as $key => $admin)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td><strong>{{ $admin->name }}</strong></td>
                                        <td>{{ $admin->username }}</td>
                                        <td>{{ $admin->created_at->format('d/m/Y') }}</td>
                                        <td>
                                            <a href="{{ route('owner.admins.edit', $admin) }}" class="btn btn-outline-pink btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            @if($admin->id !== auth()->id())
                                                <button type="button"
                                                        class="btn btn-outline-danger btn-sm"
                                                        onclick="confirmDelete('{{ route('owner.admins.destroy', $admin) }}', '{{ $admin->name }}')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4 text-muted">
                                            <i class="fas fa-user-slash fa-2x d-block mb-2"></i>
                                            Belum ada admin.
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
        title: 'Yakin hapus admin ini?',
        text: "Admin '" + name + "' akan dihapus permanen!",
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

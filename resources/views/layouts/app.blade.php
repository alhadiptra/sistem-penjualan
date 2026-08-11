<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MochiHaanShop')</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- CSS Global -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    @stack('styles')
</head>
<body>

    <!-- NAVBAR -->
    @auth
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('landing') }}">
                <img src="{{ asset('images/logo-mochi.png') }}" alt="MochiHaanShop" height="40" style="border-radius: 10px;">
                <span class="ms-2">MochiHaanShop</span>
            </a>
            <div class="d-flex align-items-center gap-2">
                <span class="text-muted me-2">
                    <i class="fas fa-user-circle"></i> {{ auth()->user()->name }}
                    @if(auth()->user()->role == 'owner')
                        <span class="badge bg-warning text-dark">👑 Owner</span>
                    @elseif(auth()->user()->role == 'admin')
                        <span class="badge bg-primary">🛡️ Admin</span>
                    @else
                        <span class="badge bg-success">🛒 Customer</span>
                    @endif
                </span>
                <a href="{{
                    auth()->user()->role == 'owner' ? route('owner.dashboard') :
                    (auth()->user()->role == 'admin' ? route('admin.dashboard') :
                    route('customer.home'))
                }}" class="btn btn-outline-pink btn-sm">
                    <i class="fas fa-chart-pie me-1"></i> Dashboard
                </a>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-pink btn-sm">
                        <i class="fas fa-sign-out-alt me-1"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>
    @endauth

    <!-- CONTENT -->
    <main style="{{ auth()->check() ? 'padding-top: 80px;' : '' }}">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            timer: 3000,
            showConfirmButton: false,
            toast: true,
            position: 'top-end'
        });
    </script>
    @endif

    @if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '{{ session('error') }}',
            timer: 3000,
            showConfirmButton: false,
            toast: true,
            position: 'top-end'
        });
    </script>
    @endif

    @stack('scripts')
</body>
</html>

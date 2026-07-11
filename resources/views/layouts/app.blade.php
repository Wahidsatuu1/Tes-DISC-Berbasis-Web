<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'EQUITYWORLD FUTURES')</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">

    <!-- Font Google: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- AdminLTE v4 (Bootstrap 5) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@4.0.0-beta2/dist/css/adminlte.min.css">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <!-- CSS Kustom -->
    <style>
        body { font-family: 'Inter', sans-serif; }
        
        /* Sidebar Tema Oranye & Putih */
        .app-sidebar { 
            background: linear-gradient(180deg, #fd7e14 0%, #e8590c 100%) !important; 
            border-right: none; 
            box-shadow: 4px 0 20px rgba(0,0,0,0.05); 
        }
        .sidebar-brand { 
            font-weight: 800; font-size: 0.9rem; color: #ffffff !important; padding: 1rem 0.5rem; 
            display: flex; align-items: center; justify-content: center;
            background: #000000;
            border-bottom: 1px solid rgba(255,255,255,0.2);
            letter-spacing: 0.2px;
            white-space: nowrap;
            overflow: hidden;
        }
        
        /* Gaya Menu Sidebar */
        .sidebar-menu .nav-header {
            color: rgba(255,255,255,0.7) !important;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 1rem 1rem 0.5rem 1rem;
        }
        .sidebar-menu .nav-link { 
            border-radius: 8px; margin: 0.2rem 0.8rem; 
            color: rgba(255,255,255,0.9) !important;
            transition: all 0.3s ease; 
        }
        .sidebar-menu .nav-link:hover, .sidebar-menu .nav-link.active { 
            background: rgba(255,255,255,0.2) !important; 
            color: #ffffff !important; 
            transform: translateX(5px);
        }
        .sidebar-menu .nav-icon { color: rgba(255,255,255,0.8); transition: color 0.3s ease; }
        .sidebar-menu .nav-link:hover .nav-icon, .sidebar-menu .nav-link.active .nav-icon { color: #ffffff; }

        /* Peningkatan Kartu dan Kotak */
        .card { 
            border: none; border-radius: 12px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.04); 
            transition: transform 0.3s ease, box-shadow 0.3s ease; 
        }
        .card-header { 
            background-color: transparent; border-bottom: 1px solid var(--bs-border-color); 
            padding: 1.2rem 1.5rem;
            border-radius: 12px 12px 0 0 !important; 
        }
        .card-title {
            font-weight: 600;
            color: var(--bs-body-color);
            font-size: 1.1rem;
        }
        
        /* Kartu Statistik */
        .stat-card {
            background: var(--bs-body-bg);
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 4px 6px rgba(0,0,0,0.04);
            border-left: 5px solid #fd7e14;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: transform 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0,0,0,0.08);
        }
        .stat-card .info { flex-grow: 1; }
        .stat-card h3 { font-size: 1.8rem; font-weight: 700; margin: 0; color: var(--bs-body-color); }
        .stat-card p { margin: 0; color: #6c757d; font-size: 0.9rem; font-weight: 500; }
        .stat-card .icon {
            width: 60px; height: 60px; border-radius: 12px;
            background: rgba(253, 126, 20, 0.1);
            color: #fd7e14;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.8rem;
        }

        /* Tombol */
        .btn-primary { 
            background-color: #fd7e14; border-color: #fd7e14; 
        }
        .btn-primary:hover { 
            background-color: #e8590c; border-color: #e8590c; 
        }
        
        /* Peningkatan Tabel */
        .table-custom th {
            font-weight: 600;
            color: var(--bs-body-color);
            border-bottom: 2px solid var(--bs-border-color);
            padding: 1rem;
        }
        .table-custom td {
            padding: 1rem;
            vertical-align: middle;
            color: var(--bs-body-color);
            border-bottom: 1px solid var(--bs-border-color);
        }
        .badge-success-soft { background-color: #d1e7dd; color: #0f5132; padding: 0.4em 0.8em; border-radius: 6px; font-weight: 500;}
        .badge-warning-soft { background-color: #fff3cd; color: #664d03; padding: 0.4em 0.8em; border-radius: 6px; font-weight: 500;}
        
        /* Header Aplikasi */
        .app-header { border-bottom: 1px solid var(--bs-border-color); }
        
    </style>
    @stack('styles')
</head>
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
<div class="app-wrapper">

    <!-- Navbar -->
    <nav class="app-header navbar navbar-expand bg-body">
        <div class="container-fluid">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto align-items-center">
                <!-- Alih Tema -->
                <li class="nav-item">
                    <a class="nav-link" href="#" id="theme-toggle" title="Toggle Light/Dark Mode">
                        <i class="fas fa-moon fs-5" id="theme-icon"></i>
                    </a>
                </li>
                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">
                        <i class="fas fa-globe"></i> {{ strtoupper(app()->getLocale()) }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a href="{{ url('lang/id') }}" class="dropdown-item">ID - Indonesia</a></li>
                        <li><a href="{{ url('lang/en') }}" class="dropdown-item">EN - English</a></li>
                    </ul>
                </li>
                <li class="nav-item ms-3">
                    <a href="{{ route('psikotes.index') }}" class="btn btn-warning text-white btn-sm rounded-pill px-3 fw-bold shadow-sm">
                        <i class="fas fa-edit me-1"></i> Ikuti Tes DISC
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- /.navbar -->

    <!-- Wadah Sidebar Utama -->
    <aside class="app-sidebar shadow-lg" data-bs-theme="dark">
        <a href="{{ route('dashboard') }}" class="sidebar-brand text-decoration-none d-flex align-items-center justify-content-center">
            <img src="{{ asset('logo.png') }}" alt="Logo" style="height: 35px; width: auto; object-fit: contain; margin-right: 10px; filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));">
            <span class="brand-text">EQUITYWORLD</span>
        </a>
        <div class="sidebar-wrapper">
            <nav class="mt-2">
                <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                    <li class="nav-header">MENU UTAMA</li>
                    <li class="nav-item">
                        <a href="{{ route('psikotes.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-file-alt"></i>
                            <p>Mulai Tes DISC</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

    <!-- Wadah Konten. Berisi konten halaman -->
    <main class="app-main">
        <div class="app-content-header pb-1">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h4 class="mb-0 fw-bold">@yield('header')</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end text-muted">
                            <li class="breadcrumb-item"><a href="#" class="text-decoration-none" style="color: #fd7e14;">{{ __('messages.dashboard') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('messages.overview') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="app-content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
    </main>

    <!-- Footer Utama -->
    <footer class="app-footer bg-body border-top">
        <div class="float-end d-none d-sm-inline text-muted">
            Sistem Informasi SDM
        </div>
        <strong class="text-muted">Copyright &copy; 2026 EQUITYWORLD FUTURES.</strong> All rights reserved.
    </footer>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<!-- Bootstrap 5 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Aplikasi AdminLTE -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@4.0.0-beta2/dist/js/adminlte.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const themeToggle = document.getElementById('theme-toggle');
        const themeIcon = document.getElementById('theme-icon');
        const htmlElement = document.documentElement;

        const savedTheme = localStorage.getItem('theme') || 'light';
        htmlElement.setAttribute('data-bs-theme', savedTheme);
        updateIcon(savedTheme);

        themeToggle.addEventListener('click', (e) => {
            e.preventDefault();
            const currentTheme = htmlElement.getAttribute('data-bs-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            
            htmlElement.setAttribute('data-bs-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            updateIcon(newTheme);
        });

        function updateIcon(theme) {
            if (theme === 'dark') {
                themeIcon.classList.remove('fa-moon');
                themeIcon.classList.add('fa-sun');
            } else {
                themeIcon.classList.remove('fa-sun');
                themeIcon.classList.add('fa-moon');
            }
        }
    });
</script>
@stack('scripts')
</body>
</html>

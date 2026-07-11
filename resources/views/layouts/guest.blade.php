<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'EQUITYWORLD FUTURES')</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">

    <!-- Font Google: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    
    <!-- CSS Kustom -->
    <style>
        body { font-family: 'Inter', sans-serif; }
        
        .navbar-brand-custom {
            font-weight: 800; font-size: 1.2rem; color: #ffffff !important; 
            letter-spacing: 0.5px;
        }

        /* Peningkatan Kartu dan Kotak */
        .card { 
            border: none; border-radius: 12px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.04); 
            transition: transform 0.3s ease, box-shadow 0.3s ease; 
        }

        .btn-primary { 
            background-color: #fd7e14; border-color: #fd7e14; 
        }
        .btn-primary:hover { 
            background-color: #e8590c; border-color: #e8590c; 
        }
    </style>
    @stack('styles')
</head>
<body class="bg-body-tertiary">

    <nav class="navbar navbar-expand bg-body shadow-sm mb-4" style="border-bottom: 3px solid #fd7e14; position: relative;">
        <div class="container d-flex justify-content-center align-items-center position-relative">
            @if(request()->is('psikotes'))
                <a href="{{ url('/') }}" class="text-decoration-none position-absolute start-0 ms-3" style="color: var(--bs-body-color);" title="Kembali">
                    <i class="fas fa-arrow-left fs-5"></i>
                </a>
            @endif
            <a href="{{ url('/') }}" class="navbar-brand fw-bold m-0 d-flex align-items-center" style="color: #fd7e14; letter-spacing: 1px;">
                <img src="{{ asset('logo.png') }}" alt="Logo" style="height: 30px; width: auto; object-fit: contain; margin-right: 8px;">
                EQUITYWORLD FUTURES
            </a>
            
            <div class="position-absolute end-0 me-3 d-flex align-items-center">
                <!-- Alih Tema -->
                <a class="nav-link me-3" href="#" id="theme-toggle" title="Toggle Light/Dark Mode" style="color: var(--bs-body-color);">
                    <i class="fas fa-moon fs-5" id="theme-icon"></i>
                </a>
                
                <!-- Dropdown Bahasa -->
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" style="color: var(--bs-body-color); text-decoration: none;">
                        <i class="fas fa-globe"></i> {{ strtoupper(app()->getLocale()) }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a href="{{ url('lang/id') }}" class="dropdown-item">ID - Indonesia</a></li>
                        <li><a href="{{ url('lang/en') }}" class="dropdown-item">EN - English</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Konten Utama -->
    <main>
        <div class="container pb-5">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="text-center text-muted py-4 mt-auto">
        <small>Sistem Informasi SDM <br> <strong>Copyright &copy; 2026 EQUITYWORLD FUTURES.</strong> All rights reserved.</small>
    </footer>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<!-- Bootstrap 5 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const themeToggle = document.getElementById('theme-toggle');
        const themeIcon = document.getElementById('theme-icon');
        const htmlElement = document.documentElement;

        const savedTheme = localStorage.getItem('theme') || 'light';
        htmlElement.setAttribute('data-bs-theme', savedTheme);
        updateIcon(savedTheme);

        if (themeToggle) {
            themeToggle.addEventListener('click', (e) => {
                e.preventDefault();
                const currentTheme = htmlElement.getAttribute('data-bs-theme');
                const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
                
                htmlElement.setAttribute('data-bs-theme', newTheme);
                localStorage.setItem('theme', newTheme);
                updateIcon(newTheme);
            });
        }

        function updateIcon(theme) {
            if (!themeIcon) return;
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

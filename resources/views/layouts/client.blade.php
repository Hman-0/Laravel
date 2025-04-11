<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'TechStore') | TechStore</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-color: #6366f1;
            --primary-dark: #4f46e5;
            --primary-light: #818cf8;
            --dark-color: #1f2937;
            --light-color: #f9fafb;
            --gray-color: #6b7280;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
        }

        .navbar-brand img {
            height: 40px;
        }

        .nav-link {
            position: relative;
            font-weight: 500;
            color: var(--gray-color);
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            color: var(--primary-color);
        }

        .nav-link.active {
            color: var(--primary-color);
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background-color: var(--primary-color);
            transition: width 0.3s ease;
        }

        .nav-link:hover::after,
        .nav-link.active::after {
            width: 100%;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
        }

        .btn-outline-primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0,0,0,0.1);
        }

        .icon-circle {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: rgba(99, 102, 241, 0.1);
            color: var(--primary-color);
            transition: all 0.3s ease;
        }

        .icon-circle:hover {
            background-color: var(--primary-color);
            color: white;
        }

        footer {
            background-color: var(--dark-color);
            color: white;
        }

        footer a {
            color: #cbd5e1;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        footer a:hover {
            color: white;
            text-decoration: none;
        }

        .social-icons a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            background-color: rgba(255,255,255,0.1);
            border-radius: 50%;
            margin-right: 10px;
            transition: all 0.3s ease;
        }

        .social-icons a:hover {
            background-color: var(--primary-color);
            transform: translateY(-3px);
        }

        .contact-info i {
            color: var(--primary-light);
            width: 20px;
            margin-right: 10px;
        }

        .badge-cart {
            position: absolute;
            top: -8px;
            right: -8px;
            background-color: #ef4444;
            color: white;
            border-radius: 50%;
            font-size: 0.75rem;
            width: 18px;
            height: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
    @yield('styles')
</head>
<body>
    <!-- Header -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-3">
            <div class="container">
                <!-- Logo -->
                <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" class="text-primary">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <span class="ms-2 fw-bold text-primary">TechStore</span>
                </a>

                <!-- Mobile Toggle Button -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Navigation Links -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item px-2">
                            <a class="nav-link active" href="{{ route('home') }}">Trang chủ</a>
                        </li>
                        <li class="nav-item px-2">
                            <a class="nav-link" href="{{ route('products') }}">Sản phẩm</a>
                        </li>
                        <li class="nav-item px-2">
                            <a class="nav-link" href="">Liên hệ</a>
                        </li>
                    </ul>

                    <!-- User Actions -->
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item px-2">
                            @auth
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="nav-link">
                                        <i class="fas fa-user"></i>
                                        Đăng xuất
                                    </button>
                                </form>
                            @else
                                <a class="nav-link" href="{{ route('login') }}">
                                    <i class="fas fa-user"></i>
                                </a>
                            @endauth
                        </li>
                        <li class="nav-item px-2">
                            <a class="nav-link position-relative" href="#">
                                <i class="fas fa-shopping-cart"></i>
                                <span class="badge-cart">3</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Breadcrumb -->
    @yield('breadcrumb')

    <!-- Main Content -->
    <main class="py-4">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="pt-5 pb-4">
        <div class="container">
            <div class="row gy-4">
                <!-- Company Info -->
                <div class="col-lg-4 col-md-6">
                    <div class="d-flex align-items-center mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" class="text-primary">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <h4 class="ms-2 mb-0 fw-bold">TechStore</h4>
                    </div>
                    <p class="text-muted mb-4">Cửa hàng công nghệ đáng tin cậy với các sản phẩm chất lượng cao và giá cả tốt nhất.</p>

                    <div class="social-icons">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="col-lg-4 col-md-6">
                    <h5 class="fw-bold mb-3">Liên kết nhanh</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="{{ route('home') }}">Trang chủ</a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('products') }}">Sản phẩm</a>
                        </li>
                        <li class="mb-2">
                            <a href="#">Về chúng tôi</a>
                        </li>
                        <li>
                            <a href="">Liên hệ</a>
                        </li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div class="col-lg-4 col-md-6">
                    <h5 class="fw-bold mb-3">Liên hệ</h5>
                    <ul class="list-unstyled contact-info">
                        <li class="d-flex mb-3">
                            <i class="fas fa-map-marker-alt mt-1"></i>
                            <span>123 Đường Chính, Thành phố</span>
                        </li>
                        <li class="d-flex mb-3">
                            <i class="fas fa-phone mt-1"></i>
                            <span>+84 123 456 789</span>
                        </li>
                        <li class="d-flex">
                            <i class="fas fa-envelope mt-1"></i>
                            <span>info@techstore.com</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Copyright -->
            <div class="border-top mt-4 pt-4 text-center text-muted">
                <p class="mb-0">© {{ date('Y') }} TechStore. Tất cả quyền được bảo lưu.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    @yield('scripts')
</body>
</html>

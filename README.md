<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

your-project/
├── app/
│   ├── Console/           # Lệnh artisan (custom command)
│   ├── Exceptions/        # Xử lý ngoại lệ
│   ├── Http/              # Controllers, Middleware, Requests
│   │   ├── Controllers/
│   │   ├── Middleware/
│   │   └── Requests/
│   ├── Models/            # Model Eloquent
│   └── Providers/         # Các Service Provider
│
├── bootstrap/
│   └── cache/             # Cache của config và routes
│
├── config/                # Cấu hình của app (database, mail, queue, ...)
│
├── database/
│   ├── factories/         # Các factory tạo dữ liệu giả
│   ├── migrations/        # Các tệp migration (tạo bảng)
│   └── seeders/           # Dữ liệu khởi tạo
│
├── lang/                  # File ngôn ngữ (đa ngôn ngữ)
│
├── public/                # Root web server. Chứa index.php, asset tĩnh
│
├── resources/
│   ├── js/                # File JS (nếu dùng Vite)
│   ├── sass/              # File SCSS/SASS (nếu dùng Vite)
│   ├── views/             # Blade templates
│   └── lang/              # Cấu trúc ngôn ngữ dạng JSON hoặc PHP
│
├── routes/
│   ├── web.php            # Route cho giao diện web
│   ├── api.php            # Route cho API
│   ├── console.php        # Route cho command
│   └── channels.php       # Route cho broadcasting
│
├── storage/
│   ├── app/               # File người dùng tải lên
│   ├── framework/         # Session, views đã biên dịch, cache
│   └── logs/              # Log hệ thống
│
├── tests/                 # Unit tests, Feature tests
│
├── vendor/                # Các package do composer cài
│
├── .env                   # File cấu hình môi trường
├── artisan                # File CLI để chạy command Laravel
├── composer.json          # Quản lý package PHP
├── package.json           # Quản lý package JS (nếu dùng Vite)
├── vite.config.js         # File cấu hình Vite
└── README.md


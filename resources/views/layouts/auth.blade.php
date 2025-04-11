<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Auth Page') }}</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f5f7fa;
            background-image: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            background-attachment: fixed;
        }

        .auth-card {
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05), 0 5px 10px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }

        .input-field {
            transition: all 0.3s ease;
        }

        .input-field:focus {
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15);
        }

        .btn-primary {
            background-image: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .social-btn {
            transition: all 0.3s ease;
        }

        .social-btn:hover {
            transform: translateY(-2px);
        }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen py-10">
    <!-- Logo Area -->
    <div class="fixed top-6 left-1/2 transform -translate-x-1/2">
        <div class="flex items-center justify-center space-x-2">
            <div class="h-10 w-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center">
                <i class="fas fa-shield-alt text-white text-xl"></i>
            </div>
            <span class="text-xl font-bold text-gray-800 mx-2">{{ config('app.name', 'SecureAuth') }}</span>
        </div>
    </div>

    <!-- Auth Card -->
    <div class="w-full max-w-md bg-white bg-opacity-95 rounded-xl auth-card p-8">
        <!-- Card Header -->
        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">@yield('page_title', 'Welcome Back')</h2>
            <p class="text-gray-600">@yield('page_subtitle', 'Sign in to continue')</p>
        </div>

        <!-- Main Content -->
        @yield('content')

        <!-- Divider -->
        <div class="my-6 flex items-center justify-center">
            <div class="flex-grow h-px bg-gray-200"></div>
            <span class="px-4 text-sm text-gray-500">OR</span>
            <div class="flex-grow h-px bg-gray-200"></div>
        </div>

        <!-- Social Login Buttons -->
        <div class="grid grid-cols-3 gap-3 mb-6">
            <button class="social-btn flex items-center justify-center py-2 px-4 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                <i class="fab fa-facebook-f"></i>
            </button>
            <button class="social-btn flex items-center justify-center py-2 px-4 bg-red-600 text-white rounded-lg hover:bg-red-700">
                <i class="fab fa-google"></i>
            </button>
            <button class="social-btn flex items-center justify-center py-2 px-4 bg-gray-800 text-white rounded-lg hover:bg-gray-900">
                <i class="fab fa-github"></i>
            </button>
        </div>

        <!-- Form Footer -->
        <div class="text-center text-sm text-gray-600">
            @yield('form_footer', 'Don\'t have an account? <a href="#" class="text-indigo-600 hover:text-indigo-800 font-medium">Create Account</a>')
        </div>
    </div>

    <!-- Page Footer -->
    <div class="fixed bottom-4 left-1/2 transform -translate-x-1/2 text-center text-gray-600 text-sm">
        <div class="mb-2">
            <a href="#" class="text-gray-600 hover:text-gray-800 mx-2">Privacy Policy</a>
            <a href="#" class="text-gray-600 hover:text-gray-800 mx-2">Terms of Service</a>
            <a href="#" class="text-gray-600 hover:text-gray-800 mx-2">Support</a>
        </div>
        &copy; {{ date('Y') }} {{ config('app.name', 'SecureAuth') }}. All rights reserved.
    </div>
</body>

</html>


@extends('layouts.auth')

@section('page_title', 'Đăng nhập')
@section('page_subtitle', 'Đăng nhập để truy cập tài khoản của bạn')

@section('content')
<!-- Form Login -->
<form method="POST" action="{{ route('login-post') }}" class="space-y-6">
    @csrf

    <!-- Status Messages -->
    @if(session('status'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg mb-4" role="alert">
        <p>{{ session('status') }}</p>
    </div>
@endif

@if(session('error'))
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg mb-4" role="alert">
        <p>{{ session('error') }}</p>
    </div>
@endif

@if($errors->any())
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg mb-4" role="alert">
        <p class="font-medium">Vui lòng kiểm tra lại thông tin đăng ký</p>
        <ul class="mt-1 list-disc list-inside text-sm">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <!-- Email Field -->
    <div class="space-y-2">
        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-envelope text-gray-400"></i>
            </div>
            <input id="email" type="email" name="email" value="{{ old('email') }}"  autofocus
                class="input-field w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('email') border-red-500 @enderror"
                placeholder="name@example.com">
        </div>
        @error('email')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Password Field -->
    <div class="space-y-2">
        <div class="flex justify-between">
            <label for="password" class="block text-sm font-medium text-gray-700">Mật khẩu</label>
            <a href="" class="text-sm text-indigo-600 hover:text-indigo-800">Quên mật khẩu?</a>
        </div>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-lock text-gray-400"></i>
            </div>
            <input id="password" type="password" name="password"
                class="input-field w-full pl-10 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('password') border-red-500 @enderror"
                placeholder="••••••••">
        </div>
        @error('password')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Remember Me -->
    <div class="flex items-center">
        <input id="remember_me" type="checkbox" name="remember" class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
        <label for="remember_me" class="ml-2 block text-sm text-gray-700">Ghi nhớ đăng nhập</label>
    </div>

    <!-- Login Button -->
    <div>
        <button type="submit" class="btn-primary w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            <i class=""></i> Đăng nhập
        </button>
    <!-- Register Button -->
    <div class="text-center mt-4">
        <a href="{{ route('showRegister') }}" class="btn-secondary flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            <i class=""></i> Đăng ký
        </a>
    </div>

    </div>
</form>
@endsection

@section('form_footer')
Chưa có tài khoản? <a href="{{ route('showRegister') }}" class="text-indigo-600 hover:text-indigo-800 font-medium">Đăng ký ngay</a>
@endsection

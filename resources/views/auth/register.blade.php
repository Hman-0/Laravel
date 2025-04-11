@extends('layouts.auth')

@section('page_title', 'Đăng ký')
@section('page_subtitle', 'Tạo tài khoản mới')

@section('content')
<!-- Form Register -->
<form method="POST" action="{{ route('auth.register-post') }}" class="space-y-6">
    @csrf

    <!-- Status & Error Messages -->
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

    <!-- Name Field -->
    <div class="space-y-2">
        <label for="name" class="block text-sm font-medium text-gray-700">Họ và tên</label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-user text-gray-400"></i>
            </div>
            <input id="name" type="text" name="name" value="{{ old('name') }}"  autofocus
                class="input-field w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('name') border-red-500 @enderror"
                placeholder="Nguyễn Văn A">
        </div>
        @error('name')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Email Field -->
    <div class="space-y-2">
        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-envelope text-gray-400"></i>
            </div>
            <input id="email" type="email" name="email" value="{{ old('email') }}"
                class="input-field w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('email') border-red-500 @enderror"
                placeholder="name@example.com">
        </div>
        @error('email')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Password Field -->
    <div class="space-y-2">
        <label for="password" class="block text-sm font-medium text-gray-700">Mật khẩu</label>
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

    <!-- Confirm Password Field -->
    <div class="space-y-2">
        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Xác nhận mật khẩu</label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-lock text-gray-400"></i>
            </div>
            <input id="password_confirmation" type="password" name="password_confirmation"
                class="input-field w-full pl-10 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                placeholder="••••••••">
        </div>
        @error('password_confirmation')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Terms and Conditions -->
    <div class="flex items-start">
        <div class="flex items-center h-5">
            <input id="terms" name="terms" type="checkbox"
                class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500 @error('terms') border-red-500 @enderror">
        </div>
        <div class="ml-3 text-sm">
            <label for="terms" class="text-gray-700">Tôi đồng ý với <a href="#" class="text-indigo-600 hover:text-indigo-800">Điều khoản dịch vụ</a> và <a href="#" class="text-indigo-600 hover:text-indigo-800">Chính sách bảo mật</a></label>
            @error('terms')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <!-- Register Button -->
    <div>
        <button type="submit" class="btn-primary w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            <i class="fas fa-user-plus mr-2"></i> Đăng ký
        </button>
    </div>
</form>
@endsection

@section('form_footer')
Đã có tài khoản? <a href="{{ route('auth.login') }}" class="text-indigo-600 hover:text-indigo-800 font-medium">Đăng nhập</a>
@endsection


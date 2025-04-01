@extends('layouts.admin')

@section('title', 'Thêm khách hàng')

@section('content')
    <h1>Thêm khách hàng</h1>
    <form action="{{ route('admin.customers.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Tên khách hàng</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" aria-describedby="name"  value="{{ old('name') }}">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" aria-describedby="email"  value="{{ old('email') }}">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mật khẩu </label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" aria-describedby="password" >
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
   
        <div class="mb-3">
            <label for="phone" class="form-label">Số điện thoại</label>
            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" aria-describedby="phone"  value="{{ old('phone') }}">
            @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Địa chỉ</label>
            <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" aria-describedby="address"  value="{{ old('address') }}">
            @error('address')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Thêm</button>
    </form>
@endsection


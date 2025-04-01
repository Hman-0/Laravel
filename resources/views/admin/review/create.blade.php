@extends('layouts.admin')

@section('title', 'Thêm bài viết')

@section('content')
    <h1>Thêm bài viết</h1>
    <form action="{{ route('admin.reviews.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Tên</label>
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
            <label for="phone" class="form-label">Số điện thoại</label>
            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" aria-describedby="phone"  value="{{ old('phone') }}">
            @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Nội dung</label>
            <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" aria-describedby="content" >{{ old('content') }}</textarea>
            @error('content')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="rating" class="form-label">Đánh giá</label>
            <input type="number" class="form-control @error('rating') is-invalid @enderror" id="rating" name="rating" aria-describedby="rating"  value="{{ old('rating') }}">
            @error('rating')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Thêm</button>
    </form>
@endsection


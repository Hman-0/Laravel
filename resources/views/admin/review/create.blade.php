@extends('layouts.admin')

@section('title', 'Thêm đánh giá')

@section('content')
    <h1>Thêm đánh giá</h1>
    <form action="{{ route('admin.reviews.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="user_id">Người dùng</label>
            <select name="user_id" id="user_id" class="form-control @error('user_id') is-invalid @enderror">
                <option value="">Chọn người dùng</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                @endforeach
            </select>
            @error('user_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="product_id">Sản phẩm</label>
            <select name="product_id" id="product_id" class="form-control @error('product_id') is-invalid @enderror">
                <option value="">Chọn sản phẩm</option>
                @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->ten_san_pham }}</option>
                @endforeach
            </select>
            @error('product_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="content">Nội dung</label>
            <textarea name="content" id="content" class="form-control @error('content') is-invalid @enderror">{{ old('content') }}</textarea>
            @error('content')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="rating">Đánh giá</label>
            <select name="rating" id="rating" class="form-control @error('rating') is-invalid @enderror">
                <option value="">Chọn đánh giá</option>
                @for($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}">{{ $i }} sao</option>
                @endfor
            </select>
            @error('rating')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Thêm</button>
    </form>
@endsection

@extends('layouts.admin')

@section('title', 'Edit Review')

@section('content')
    <h1>Edit Review</h1>
    <form action="{{ route('admin.reviews.update', $review->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="user_id">Người dùng</label>
            <select name="user_id" id="user_id" class="form-control @error('user_id') is-invalid @enderror">
                <option value="">Chọn người dùng</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $review->user_id == $user->id ? 'selected' : '' }}>
                        {{ $user->name }} ({{ $user->email }})
                    </option>
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
                    <option value="{{ $product->id }}" {{ $review->product_id == $product->id ? 'selected' : '' }}>
                        {{ $product->ten_san_pham }}
                    </option>
                @endforeach
            </select>
            @error('product_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="content">Nội dung</label>
            <textarea name="content" id="content" class="form-control @error('content') is-invalid @enderror">{{ $review->content }}</textarea>
            @error('content')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="rating">Đánh giá</label>
            <select name="rating" id="rating" class="form-control @error('rating') is-invalid @enderror">
                <option value="">Chọn đánh giá</option>
                @for($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}" {{ $review->rating == $i ? 'selected' : '' }}>{{ $i }} sao</option>
                @endfor
            </select>
            @error('rating')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
@endsection

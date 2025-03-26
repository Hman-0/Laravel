@extends('layouts.admin')

@section('title', 'Sửa banner')

@section('content')
    <form action="{{ route('admin.banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="ten_banner" class="form-label">Tên banner</label>
            <input type="text" name="ten_banner" class="form-control @error('ten_banner') is-invalid @enderror" value="{{ old('ten_banner', $banner->ten_banner) }}">
            @error('ten_banner')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="anh" class="form-label">Hình ảnh </label>
            <input type="file" name="anh" class="form-control @error('anh') is-invalid @enderror">
            @error('anh')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <img src="{{ asset('storage/' . $banner->anh) }}" width="100" alt="" class="mt-2">
        </div>

        <div class="mb-3">
            <label for="link" class="form-label">Link </label>
            <input type="text" name="link" class="form-control @error('link') is-invalid @enderror" value="{{ old('link', $banner->link) }}">
            @error('link')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Sửa </button>
        <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary">Quay lại </a>
    </form>
@endsection

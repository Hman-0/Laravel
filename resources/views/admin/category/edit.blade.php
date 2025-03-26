@extends('layouts.admin')

@section('title', 'Sửa danh mục')

@section('content')
    <div class="page-header">
        <h1>Sửa danh mục</h1>
    </div>
    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="ten_danh_muc" class="form-label">Tên danh mục</label>
            <input type="text" name="ten_danh_muc" class="form-control @error('ten_danh_muc') is-invalid @enderror" value="{{ old('ten_danh_muc', $category->ten_danh_muc) }}">
            @error('ten_danh_muc')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Trạng thái</label>
            <select name="trang_thai" class="form-select @error('trang_thai') is-invalid @enderror">
                <option value="1" {{ old('trang_thai', $category->trang_thai) == 1 ? 'selected' : '' }}>Hiển thị</option>
                <option value="0" {{ old('trang_thai', $category->trang_thai) == 0 ? 'selected' : '' }}>Ẩn</option>
            </select>
            @error('trang_thai')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Sửa</button>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
@endsection

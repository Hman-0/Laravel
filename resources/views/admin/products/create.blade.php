@extends('layouts.admin')

@section('title', 'Thêm sản phẩm')

@section('content')
    <div class="container">
        <h2 class="mb-4">Thêm sản phẩm</h2>

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label">Mã sản phẩm</label>
                <input type="text" name="ma_san_pham" class="form-control @error('ma_san_pham') is-invalid @enderror"
                    value="{{ old('ma_san_pham') }}">
                @error('ma_san_pham')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Tên sản phẩm</label>
                <input type="text" name="ten_san_pham" class="form-control @error('ten_san_pham') is-invalid @enderror"
                    value="{{ old('ten_san_pham') }}">
                @error('ten_san_pham')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label fw-bold">Danh mục:</label>
                <select name="category_id" class="form-select @error('category_id') is-invalid @enderror">
                    <option value="">Chọn danh mục</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->ten_danh_muc }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Giá sản phẩm</label>
                <input type="number" name="gia_san_pham" class="form-control @error('gia_san_pham') is-invalid @enderror" value="{{ old('gia_san_pham') }}">
                @error('gia_san_pham')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Giảm giá</label>
                <input type="number" name="giam_gia" class="form-control @error('giam_gia') is-invalid @enderror" min="0" max="{{ old('gia_san_pham') }}" value="{{ old('giam_gia') }}">
                @error('giam_gia')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Ảnh sản phẩm</label>
                <input type="file" name="img" class="form-control @error('img') is-invalid @enderror">
                @error('img')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Số lượng</label>
                <input type="number" name="so_luong" class="form-control @error('so_luong') is-invalid @enderror" value="{{ old('so_luong') }}">
                @error('so_luong')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Ngày nhập kho</label>
                <input type="date" name="ngay_nhap_kho" class="form-control @error('ngay_nhap_kho') is-invalid @enderror" value="{{ old('ngay_nhap_kho') }}">
                @error('ngay_nhap_kho')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Mô tả</label>
                <textarea name="mo_ta" class="form-control @error('mo_ta') is-invalid @enderror" rows="3">{{ old('mo_ta') }}</textarea>
                @error('mo_ta')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Trạng thái</label>
                <select name="trang_thai" class="form-select @error('trang_thai') is-invalid @enderror">
                    <option value="1" {{ old('trang_thai') == 1 ? 'selected' : '' }}>Hiển thị</option>
                    <option value="0" {{ old('trang_thai') == 0 ? 'selected' : '' }}>Ẩn</option>
                </select>
                @error('trang_thai')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
@endsection


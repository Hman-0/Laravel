@extends('layouts.admin')

@section('title', 'Danh sách Banners')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Danh sách Banners</h1>
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="card shadow-sm mb-4">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0"><i class="fas fa-search"></i> Tìm kiếm sản phẩm</h5>
    </div>
<div class="card-body">
    <form method="GET" action="{{ route('admin.banners.index') }}">
        <div class="row g-3">
            <!-- Mã banner -->
            <div class="col-md-3">
                <label class="form-label">Tên banner</label>
                <input type="text" name="ten_banner" class="form-control" placeholder="Nhập tên banner"
                    value="{{ request()->query('ten_banner') }}">
            </div>
            <div class="col-md-3 ms-auto d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100 me-1">
                    <i class="fas fa-search"></i> Tìm kiếm
                </button>
                <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary w-100 ms-1">
                    <i class="fas fa-sync"></i> Làm mới
                </a>
            </div>
        </div>
    </form>
</div>
</div>
</div>
    <a href="{{ route('admin.banners.create') }}" class="btn btn-primary mb-3">Thêm banner </a>
    <a href="{{ route('admin.banners.delete') }}" class="btn btn-danger mb-3">Thùng rác  </a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên Banner</th>
                <th>Hình Ảnh</th>
                <th>Liên Kết</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($banners as $banner)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $banner->ten_banner }}</td>
                <td><img src="{{ asset('storage/' . $banner->anh) }}" alt="{{ $banner->ten_banner }}" width="100"></td>
                <td><a href="{{ $banner->link }}" target="_blank">{{ $banner->link }}</a></td>
                <td class="text-center d-flex justify-content-center align-items-center">
                    <a href="{{ route('admin.banners.edit', $banner->id) }}" class="btn btn-primary btn-sm mr-2">Sửa</a>
                    <form action="{{ route('admin.banners.destroy', $banner->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection


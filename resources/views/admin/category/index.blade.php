@extends('layouts.admin')

@section('title', 'Danh sách danh mục')

@section('content')
    <div class="page-header d-flex justify-content-between align-items-center mb-3">
        <h1 class="m-0">Danh sách danh mục</h1>
    </div>

    {{-- Thông báo --}}
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Card tìm kiếm --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fas fa-search"></i> Tìm kiếm danh mục</h5>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('admin.categories.index') }}">
                <div class="row g-3">
                    <!-- Tên danh mục -->
                    <div class="col-md-4">
                        <label class="form-label">Tên danh mục</label>
                        <select name="ten_danh_muc" class="form-select">
                            <option value="">-- Tất cả --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->ten_danh_muc }}"
                                    {{ request('ten_danh_muc') === $category->ten_danh_muc ? 'selected' : '' }}>
                                    {{ $category->ten_danh_muc }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Trạng thái -->
                    <div class="col-md-3">
                        <label class="form-label">Trạng thái</label>
                        <select name="trang_thai" class="form-select">
                            <option value="" >Tất cả</option>
                            <option value="1" {{ request()->query('trang_thai') == 1 ? 'selected' : '' }}>Hiển thị</option>
                            <option value="0" {{ request()->query('trang_thai') == 0 ? 'selected' : '' }}>Ẩn</option>
                        </select>
                    </div>
                    <!-- Nút tìm kiếm & Làm mới -->
                    <div class="col-md-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary me-2">
                            <i class="fas fa-search"></i> Tìm kiếm
                        </button>
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                            <i class="fas fa-sync"></i> Làm mới
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{-- Nút Thêm danh mục & Thùng rác --}}
    <div class="d-flex mb-3">
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary me-2">Thêm danh mục</a>
        <a href="{{ route('admin.categories.delete') }}" class="btn btn-danger">Thùng rác</a>
    </div>

    {{-- Bảng danh sách danh mục --}}
    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-bordered text-center">
                <thead class="table-light">
                    <tr>
                        <th width="5%">STT</th>
                        <th width="50%">Tên danh mục</th>
                        <th width="15%">Trạng thái</th>
                        <th width="30%">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->ten_danh_muc }}</td>
                            <td>
                                <span class="badge bg-{{ $category->trang_thai == 1 ? 'success' : 'danger' }}">
                                    {{ $category->trang_thai == 1 ? 'Hiển thị' : 'Ẩn' }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">Không có danh mục nào</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

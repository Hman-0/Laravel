@extends('layouts.admin')

@section('title', 'Danh sách bài viết')

@section('content')
    <h1>Danh sách bài viết</h1>
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
        <form method="GET" action="{{ route('admin.posts.index') }}">
            <div class="row g-3">
                <!-- Mã banner -->
                <div class="col-md-3">
                    <label class="form-label">Tên bài viết</label>
                    <input type="text" name="title" class="form-control" placeholder="Nhập tên bài viết"
                        value="{{ request()->query('title') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Nội dung </label>
                    <input type="text" name="content" class="form-control" placeholder="Nhập nội dung bài viết"
                        value="{{ request()->query('content') }}">
                </div>
                <div class="col-auto">
                    <label class="form-label">Danh mục</label>
                    <select name="category_id" class="form-select">
                        <option value="">Tất cả</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ request()->query('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->ten_danh_muc }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 ms-auto d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100 me-1">
                        <i class="fas fa-search"></i> Tìm kiếm
                    </button>
                    <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary w-100 ms-1">
                        <i class="fas fa-sync"></i> Làm mới
                    </a>
                </div>
            </div>
        </form>
    </div>
    </div>
    </div>
    <div class="mb-3">
        <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">Thêm mới</a>
        <a href="{{ route('admin.posts.delete') }}" class="btn btn-danger">Thùng rác </a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên bài viết</th>
                <th>Nội dung</th>
                <th>Danh mục</th>
                <th>Ảnh đại diện</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
            <tr>
                <td>{{ $post->id }}</td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->content }}</td>
                <td>{{ $post->category->ten_danh_muc }}</td>
                <td><img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" width="100"></td>
                <td>
                    <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                    <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa bài viết này không?')">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

  
 <div class="d-flex justify-content-center">
        {{ $posts->links() }}
    </div> 
@endsection

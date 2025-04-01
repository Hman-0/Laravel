@extends('layouts.admin')

@section('title', 'Danh sách bài viết')

@section('content')
    <h1>Danh sách bài viết</h1>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="mb-3">
        <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">Thêm mới</a>
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
                    <form action="{{ route('admin.posts.restore', $post->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-info btn-sm">Khôi phục </button>
                    </form>
                    <form action="{{ route('admin.posts.forceDelete', $post->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('post')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa bài viết này không?')">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

  

@endsection

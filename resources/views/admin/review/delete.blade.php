@extends('layouts.admin')

@section('title', 'Danh sách đánh giá')

@section('content')
    <h1>Danh sách đánh giá</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-3">
        <a href="{{ route('admin.reviews.create') }}" class="btn btn-primary">Thêm mới</a>
        <a href="{{ route('admin.reviews.delete') }}" class="btn btn-danger">Thùng rác</a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Email</th>
                <th>Điện thoại</th>
                <th>Nội dung</th>
                <th>Đánh giá</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reviews as $review)
                <tr>
                    <td>{{ $review->id }}</td>
                    <td>{{ $review->name }}</td>
                    <td>{{ $review->email }}</td>
                    <td>{{ $review->phone }}</td>
                    <td>{{ $review->content }}</td>
                    <td>{{ $review->rating }}</td>
                    <td>
                        <form action="{{ route('admin.reviews.restore', $review->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-sm btn-info">Khôi phục</button>
                        </form>
                        <form action="{{ route('admin.reviews.forceDelete', $review->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('POST')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $reviews->links() }}
    </div>
@endsection


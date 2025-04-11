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

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên người dùng</th>
                <th>Sản phẩm</th>
                <th>Nội dung</th>
                <th>Đánh giá</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reviews as $review)
                <tr>
                    <td>{{ $review->id }}</td>
                    <td>{{ $review->user->name }}</td>
                    <td>{{ $review->product->ten_san_pham }}</td>
                    <td>{{ $review->content }}</td>
                    <td>{{ $review->rating }}</td>
                    <td>
                        <a href="{{ route('admin.reviews.restore', $review->id) }}" class="btn btn-success">Khôi phục</a>
                        <form action="{{ route('admin.reviews.forceDelete', $review->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa vĩnh viễn?')">Xóa vĩnh viễn</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $reviews->links() }}
@endsection


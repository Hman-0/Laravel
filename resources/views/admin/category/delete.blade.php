@extends('layouts.admin')

@section('title', 'Thùng rác danh mục')

@section('content')
    <div class="page-header">
        <h1>Thùng rác danh mục</h1>
    </div>
    <a href="{{ route('admin.categories.index')}}" class="btn btn-secondary">Quay lại</a>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered">
                <thead class="thead-light">
                <tr>
                    <th>STT</th>
                    <th>Tên danh mục</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $category->ten_danh_muc }}</td>
                        <td>{{ $category->trang_thai == 1 ? 'Hiển thị' : 'Ẩn' }}</td>
                        <td>
                            <form action="{{ route('admin.categories.restore', $category->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-info btn-sm">Khôi phục</button>
                            </form>
                            <form action="{{ route('admin.categories.forceDelete', $category->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('post')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection


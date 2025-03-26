@extends('layouts.admin')

@section('title', 'Danh sách danh mục')

@section('content')
    <div class="page-header">
        <h1>Danh sách danh mục</h1>
    </div>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary mb-3"> Thêm danh mục</a>
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

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
                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection


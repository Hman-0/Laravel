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
    <a href="{{ route('admin.banners.create') }}" class="btn btn-primary mb-3">Thêm banner </a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
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


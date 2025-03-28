@extends('layouts.admin')

@section('title', 'Danh sách Banners')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Danh sách Banners</h1>
\
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
                <td >
                    <form action="{{ route('admin.banners.restore', $banner->id) }}" method="POST" class="d-inline me-2">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-info btn-sm">Khôi phục</button>
                    </form>
                    <form action="{{ route('admin.banners.forceDelete', $banner->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('POST')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa banner này không?')">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection


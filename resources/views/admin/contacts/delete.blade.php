
@extends('layouts.admin')

@section('title', 'Danh sách liên hệ')

@section('content')
<div class="card shadow-sm mb-4">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0"><i class="fas fa-address-book"></i> Danh sách liên hệ</h5>
    </div>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="card-body">
        <div class="mb-3">
            <a href="{{ route('admin.contacts.create') }}" class="btn btn-primary btn-sm">Thêm liên hệ</a>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Điện thoại</th>
                    <th>Tiêu đề</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contacts as $contact)
                <tr>
                    <td>{{ $contact->id }}</td>
                    <td>{{ $contact->name }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->phone }}</td>
                    <td>{{ $contact->title }}</td>
                    <td>
                        <form action="{{ route('admin.contacts.restore', $contact->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-sm btn-info">Khôi phục </button>
                        </form>
                        <form action="{{ route('admin.contacts.forceDelete', $contact->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('POST')
                            <button type="submit" class="btn btn-sm btn-danger">Xóa</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Hiển thị phân trang -->
        <div class="d-flex justify-content-center">
            {{ $contacts->links() }}
        </div>
    </div>
</div>
@endsection


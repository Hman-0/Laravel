
@extends('layouts.admin')

@section('title', 'Danh sách liên hệ')

@section('content')

      <h2>Danh sách liên hệ</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fas fa-search"></i> Tìm kiếm liên hệ </h5>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('admin.contacts.index') }}">
                <div class="row g-3">
                    <!-- Mã liên hệ -->
                    <div class="col-md-3">
                        <label class="form-label">Tên liên hệ</label>
                        <input type="text" name="name" class="form-control" placeholder="Nhập tên liên hệ"
                            value="{{ request()->query('name') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Nhập email"
                            value="{{ request()->query('email') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Phone </label>
                        <input type="phone" name="phone" class="form-control" placeholder="Nhập số điện thoại "
                            value="{{ request()->query('phone') }}">
                    </div>
                   
                    <div class="col-md-3 ms-auto d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100 me-1">
                            <i class="fas fa-search"></i> Tìm kiếm
                        </button>
                        <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary w-100 ms-1">
                            <i class="fas fa-sync"></i> Làm mới
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card-body">
        <div class="mb-3">
            <a href="{{ route('admin.contacts.create') }}" class="btn btn-primary btn-sm">Thêm liên hệ</a>
            <a href="{{ route('admin.contacts.delete') }}" class="btn btn-danger btn-sm">Thùng rác</a>
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
                        <a href="{{ route('admin.contacts.edit', $contact->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                        <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
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


@extends('layouts.admin')

@section('title', 'Danh sách khách hàng')

@section('content')
<h2>Danh sách khách hàng</h2>
<div class="card shadow-sm mb-4">
   
    <div>
        <h5 class="card-header bg-primary text-white">Tìm kiếm khách hàng </h5>
    </div>
    @if (session('success'))    
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
   
   

        <div class="card-body">
            <form method="GET" action="{{ route('admin.customers.index') }}">
                <div class="row g-3">
                    <!-- Mã khách hàng -->
                    <div class="col-md-3">
                        <label class="form-label">Tênkhách hàng</label>
                        <input type="text" name="name" class="form-control" placeholder="Nhập tên khách hàng"
                            value="{{ request()->query('name') }}">
                    </div>
                    <!-- Tên khách hàng -->
                    <div class="col-md-3">
                        <label class="form-label
                        ">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Nhập tên khách hàng"
                            value="{{ request()->query('email') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label
                        ">Phone</label>
                        <input type="phone" name="phone" class="form-control" placeholder="Nhập tên khách hàng"
                            value="{{ request()->query('phone') }}">
                    </div>

                    <!-- Nơi sinh -->
                    <div class="col-md-3">
                        <label class="form-label">Nơi sinh</label>
                        <input type="text" name="noi_sinh" class="form-control" placeholder="Nhập nơi sinh"
                            value="{{ request()->query('noi_sinh') }}">
                    </div>
                    <!-- Nút tìm kiếm & Làm mới -->
                    <div class="col-md-3 ms-auto d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100 me-1">
                            <i class="fas fa-search"></i> Tìm kiếm
                        </button>
                        <a href="{{ route('admin.customers.index') }}" class="btn btn-secondary w-100 ms-1">
                            <i class="fas fa-sync"></i> Làm mới
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card-body">
        <div class="mb-3">
            <a href="{{ route('admin.customers.create') }}" class="btn btn-primary btn-sm">Thêm khách hàng</a>
            <a href="{{ route('admin.customers.delete') }}" class="btn btn-danger btn-sm">Thùng rác</a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên khách hàng</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Nơi sinh</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($customers as $customer)
                    <tr>
                        <td>{{ $customer->id }}</td>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->phone }}</td>
                        <td>{{ $customer->address }}</td>
                        <td>
                            <a href="{{ route('admin.customers.edit', $customer->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                            <form action="{{ route('admin.customers.destroy', $customer->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa khách hàng này không?')">Xóa</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Hiển thị phân trang -->
        <div class="d-flex justify-content-center">
            {{ $customers->links() }}
        </div>
    </div>
</div>
@endsection


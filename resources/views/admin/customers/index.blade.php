@extends('layouts.admin')

@section('title', 'Danh sách khách hàng')

@section('content')
<div class="card shadow-sm mb-4">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0"><i class="fas fa-users"></i> Danh sách khách hàng</h5>
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('admin.customers.create') }}" class="btn btn-primary btn-sm">Thêm khách hàng</a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên khách hàng</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
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


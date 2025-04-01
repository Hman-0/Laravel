@extends('layouts.admin')

@section('title', 'Danh sách khách hàng')

@section('content')
    <h1>Danh sách khách hàng</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-3">
        <a href="{{ route('admin.customers.create') }}" class="btn btn-primary">Thêm mới</a>
        <a href="{{ route('admin.customers.delete') }}" class="btn btn-danger">Thùng rác</a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên khách hàng</th>
                <th>Email</th>
                <th>Số điện thoại</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customers as $customer)
                <tr>
                    <td>{{ $customer->id }}</td>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->phone }}</td>
                    <td>
                        <form action="{{ route('admin.customers.restore', $customer->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-sm btn-info">Khôi phục</button>
                        </form>
                        <form action="{{ route('admin.customers.forceDelete', $customer->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('POST')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa khách hàng này không?')">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $customers->links() }}
    </div>
@endsection


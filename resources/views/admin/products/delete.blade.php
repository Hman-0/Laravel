@extends('layouts.admin')

@section('title', 'Xóa sản phẩm')

@section('content')
    <div class="page-header">
        <h1>Sản phẩm đã xóa </h1>
    </div>
    <a href="{{ route('admin.products.index')}}" class="btn btn-secondary">Quay lại</a>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Mã sản phẩm</th>
                    <th scope="col">Tên sản phẩm</th>

                    <th scope="col">Danh mục sản phẩm </th>
                    <th scope="col">Giá</th>
                    <th scope="col">Số lượng</th>
                    <th scope="col">Ngày nhập kho</th>
                    <th scope="col">Ngày tạo</th>
                    <th scope="col">Ngày cập nhật</th>
                    <th scope="col">Trạng thái </th>

                    <th scope="col">Ảnh</th>
                    <th scope="col">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->ma_san_pham }}</td>
                    <td>{{ $product->ten_san_pham }}</td>
                    <td>{{ $product->category->ten_danh_muc}}</td>
                    <td>{{ number_format($product->gia_san_pham, 0, ',', '.') }} VND</td>
                    <td>{{ $product->so_luong }}</td>
                    <td>{{ $product->ngay_nhap_kho }}</td>
                    <td>{{ $product->created_at }}</td>
                    <td>{{ $product->updated_at }}</td>
                    <td><span style="color: {{ $product->trang_thai == 1 ? 'green' : 'red' }}">{{ $product->trang_thai == 1 ? 'Hiển thị' : 'Ẩn' }}</span></td>

                    <td>
                        <img src="{{ asset('storage/' . $product->img) }}" alt="Hình ảnh" width="100px">
                    </td>
                    <td>
                      
                        <form action="{{ route('admin.products.restore', $product->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-info btn-sm">Khôi phục</button>
                        </form>
                        
                       
                        <form class="d-inline" action="{{ route('admin.products.forceDelete', $product->id) }}" method="POST">
                            @csrf
                            @method('POST')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?')">Xóa</button>
                        </form>
                       
                        
                    </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Hiển thị phân trang -->
        <div class="d-flex justify-content-center">
            {{ $products->links() }}
        </div>

@endsection

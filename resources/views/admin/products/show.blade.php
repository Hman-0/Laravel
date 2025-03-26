@extends('layouts.admin')

@section('title', 'Danh sách sản phẩm')

@section('content')

    <h1 class="text-3xl font-bold underline mb-5">Danh sách sản phẩm</h1>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Mã sản phẩm</th>
                    <th scope="col">Tên sản phẩm</th>
                    <th scope="col">Danh mục</th>
                    <th scope="col">Giá</th>
                    <th scope="col">Số lượng</th>
                    <th scope="col">Ngày nhập kho</th>
                    <th scope="col">Ngày tạo</th>
                    <th scope="col">Ngày cập nhật</th>
                    <th scope="col">Ảnh</th>
                    
                </tr>
            </thead>
            <tbody>
             
                <tr>
                    <td>{{ $products->id }}</td>
                    <td>{{ $products->ma_san_pham }}</td>
                    <td>{{ $products->ten_san_pham }}</td>
                    <td>{{ $products->category->ten_danh_muc }}</td>
                    <td>{{ number_format($products->gia_san_pham, 0, ',', '.') }} VND</td>
                    <td>{{ $products->so_luong }}</td>
                    <td>{{ $products->ngay_nhap_kho }}</td>
                    <td>{{ $products->created_at->format('d/m/Y H:i') }}</td>
                    <td>{{ $products->updated_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <img src="{{ asset('storage/' . $products->img) }}" alt="Hình ảnh" width="100px">
                    </td>
                  
                </tr>
           
            </tbody>
        </table>
    </div>

@endsection

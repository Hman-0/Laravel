@extends('layouts.admin')

@section('title', 'Danh sách sản phẩm')

@section('content')

    <h1 class="text-3xl font-bold underline mb-5">Danh sách sản phẩm</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fas fa-search"></i> Tìm kiếm sản phẩm</h5>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('admin.products.index') }}">
                <div class="row g-3">
                    <!-- Mã sản phẩm -->
                    <div class="col-md-3">
                        <label class="form-label">Mã sản phẩm</label>
                        <input type="text" name="ma_san_pham" class="form-control" placeholder="Nhập mã sản phẩm"
                            value="{{ request()->query('ma_san_pham') }}">
                    </div>
                    <!-- Tên sản phẩm -->
                    <div class="col-md-3">
                        <label class="form-label
                        ">Tên sản phẩm</label>
                        <input type="text" name="ten_san_pham" class="form-control" placeholder="Nhập tên sản phẩm"
                            value="{{ request()->query('ten_san_pham') }}">
                    </div>
                    <!-- Danh mục -->
                    <div class="col-auto">
                        <label class="form-label">Danh mục</label>
                        <select name="category_id" class="form-select">
                            <option value="">Tất cả</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ request()->query('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->ten_danh_muc }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Giá </label>
                        <div class="input-group">
                            <input type="number" name="gia_san_pham_from" class="form-control" placeholder="Giá từ"
                                value="{{ request()->query('gia_san_pham_from') }}">
                            <span class="input-group-text">đ</span>
                            <input type="number" name="gia_san_pham_to" class="form-control" placeholder="Giá đến"
                                value="{{ request()->query('gia_san_pham_to') }}">
                            <span class="input-group-text">đ</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Ngày nhập kho</label>
                        <input type="date" name="ngay_nhap_kho" class="form-control"
                            value="{{ request()->query('ngay_nhap_kho') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Trạng thái</label>
                        <select name="trang_thai" class="form-select">
                            <option value="" >Tất cả</option>
                            <option value="1" {{ request()->query('trang_thai') == 1 ? 'selected' : '' }}>Hiển thị</option>
                            <option value="0" {{ request()->query('trang_thai') == 0 ? 'selected' : '' }}>Ẩn</option>
                        </select>
                    </div>
                    <!-- Nút tìm kiếm & Làm mới -->
                    <div class="col-md-3 ms-auto d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100 me-1">
                            <i class="fas fa-search"></i> Tìm kiếm
                        </button>
                        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary w-100 ms-1">
                            <i class="fas fa-sync"></i> Làm mới
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-sm">Thêm</a>
    <a href="{{ route('admin.products.delete') }}" class="btn btn-danger btn-sm">Thùng rác </a>
    
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
                        <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-info btn-sm">Show</a>
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                        <form class="d-inline" action="{{ route('admin.products.destroy', $product->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
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


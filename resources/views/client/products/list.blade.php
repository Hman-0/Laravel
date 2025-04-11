@extends('layouts.client')
@section('title', 'Danh sách sản phẩm')
@section('content')

<!-- Main Content -->
<main class="py-5">
    <div class="container">
        <div class="row g-4">
            <!-- Sidebar Filters -->
            <div class="col-lg-3">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <h4 class="fw-bold mb-4">Tùy chọn</h4>
                        <form action="{{ route('products') }}" method="GET">
                            <!-- Product Name Search -->
                            <div class="mb-4">
                                <label for="name" class="form-label fw-medium">Tên sản phẩm</label>
                                <div class="input-group">
                                    <input
                                        type="text"
                                        id="name"
                                        name="name"
                                        value="{{ request('name') }}"
                                        class="form-control"
                                        placeholder="Tìm kiếm sản phẩm...">
                                    <span class="input-group-text">
                                        <i class="fas fa-search text-muted"></i>
                                    </span>
                                </div>
                            </div>

                            <!-- Category Filter -->
                            <div class="mb-4">
                                <label for="category_id" class="form-label fw-medium">Danh mục sản phẩm</label>
                                <select
                                    id="category_id"
                                    name="category_id"
                                    class="form-select">
                                    <option value="">Chọn danh mục</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->ten_danh_muc }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Price Range -->
                            <div class="mb-4">
                                <label class="form-label fw-medium">Khoảng giá</label>
                                <div class="px-2">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span id="min-price-display">${{ number_format(request('min_price', 0)) }}</span>
                                        <span id="max-price-display">${{ number_format(request('max_price', 2000000)) }}</span>
                                    </div>
                                    <div class="mb-3">
                                        <input
                                            type="range"
                                            name="min_price"
                                            id="min_price"
                                            min="0"
                                            max="2000000"
                                            step="10000"
                                            value="{{ request('min_price', 0) }}"
                                            class="form-range"
                                            oninput="document.getElementById('min-price-display').textContent = '$' + new Intl.NumberFormat('vi-VN').format(this.value)">
                                    </div>
                                    <div>
                                        <input
                                            type="range"
                                            name="max_price"
                                            id="max_price"
                                            min="0"
                                            max="2000000"
                                            step="10000"
                                            value="{{ request('max_price', 2000000) }}"
                                            class="form-range"
                                            oninput="document.getElementById('max-price-display').textContent = '$' + new Intl.NumberFormat('vi-VN').format(this.value)">
                                    </div>
                                </div>
                            </div>

                            <!-- Hidden Sort Input -->
                            <input type="hidden" name="sort" id="sort_input" value="{{ request('sort', '') }}">

                            <!-- Action Buttons -->
                            <div class="d-flex gap-2">
                                <button
                                    type="submit"
                                    class="btn btn-primary flex-grow-1">
                                    Lọc
                                </button>
                                <a
                                    href="{{ route('products') }}"
                                    class="btn btn-light flex-grow-1">
                                    Làm mới
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Products Listing -->
            <div class="col-lg-9">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body">
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center mb-4">
                            <h1 class="h3 fw-bold mb-3 mb-sm-0">Sản phẩm</h1>

                            <!-- Sort By Form -->
                            <form id="sort-form" action="{{ route('clientt.products') }}" method="GET" class="mt-2 mt-sm-0">
                                @if(request('name'))
                                    <input type="hidden" name="name" value="{{ request('name') }}">
                                @endif
                                @if(request('category_id'))
                                    <input type="hidden" name="category_id" value="{{ request('category_id') }}">
                                @endif
                                @if(request('min_price'))
                                    <input type="hidden" name="min_price" value="{{ request('min_price') }}">
                                @endif
                                @if(request('max_price'))
                                    <input type="hidden" name="max_price" value="{{ request('max_price') }}">
                                @endif

                                <select
                                    name="sort"
                                    onchange="document.getElementById('sort-form').submit()"
                                    class="form-select form-select-sm">
                                    <option value="">Sắp xếp theo</option>
                                    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Giá: thấp đến cao</option>
                                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Giá: cao đến thấp</option>
                                </select>
                            </form>
                        </div>

                        <!-- Products Grid -->
                        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                            @forelse($products as $product)
                                <div class="col">
                                    <div class="card h-100 border-0 shadow-sm">
                                        <a href="{{ route('products.show', $product->id) }}">
                                            <img src="{{ asset('storage/'.$product->img) }}" alt="{{ $product->ten_san_pham }}" class="card-img-top" style="height: 100%; object-fit: cover;">
                                        </a>
                                        <div class="card-body">
                                            <a href="{{ route('products.show', $product->id) }}" class="text-decoration-none">
                                                <h5 class="card-title fw-semibold text-dark">{{ $product->ten_san_pham }}</h5>
                                            </a>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <div>
                                                    <span class="fs-5 fw-bold text-danger">${{ number_format($product->gia_san_pham - ($product->giam_gia ?? 0), 2) }}</span>
                                                    @if($product->giam_gia > 0)
                                                        <span class="ms-2 text-muted text-decoration-line-through">${{ number_format($product->gia_san_pham, 2) }}</span>
                                                    @endif
                                                </div>
                                                <span class="badge bg-light text-dark">
                                                    {{ $product->category ? $product->category->ten_danh_muc : 'Không có danh mục' }}
                                                </span>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="text-muted small">Còn lại: {{ $product->so_luong }}</span>
                                                <button class="btn btn-sm btn-primary">
                                                    <i class="fas fa-shopping-cart me-1"></i>Thêm vào giỏ hàng
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12 py-5 text-center">
                                    <i class="fas fa-search text-muted fa-3x mb-3"></i>
                                    <h4 class="fw-medium">Không tìm thấy sản phẩm</h4>
                                    <p class="text-muted">Vui lòng thử lại với tiêu chí tìm kiếm khác</p>
                                </div>
                            @endforelse
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center">
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection

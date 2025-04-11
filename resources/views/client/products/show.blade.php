@extends('layouts.client')
@section('title', $product->ten_san_pham)

@section('content')
<div class="container py-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="{{ route('products.index') }}" class="text-decoration-none">Sản phẩm</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $product->ten_san_pham }}</li>
        </ol>
    </nav>

    <!-- Product Details -->
    <div class="row g-4 mb-5">
        <!-- Product Image -->
        <div class="col-md-5">
            <div class="card border-0 shadow-sm">
                <img src="{{ asset('storage/' . $product->img) }}" class="img-fluid rounded" alt="{{ $product->ten_san_pham }}">
            </div>
        </div>

        <!-- Product Info -->
        <div class="col-md-7">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h1 class="h2 fw-bold mb-3">{{ $product->ten_san_pham }}</h1>

                    <!-- Rating (commented out as per your original code) -->
                    <div class="mb-3">
                        <div class="d-flex align-items-center">
                            <div class="text-warning me-2">
                                @php
                                    if ($reviews instanceof \Illuminate\Support\Collection) {
                                        $averageRating = $reviews->avg('rating') ?? 0;
                                        $reviewCount = $reviews->count();
                                    } else {
                                        $averageRating = count($reviews) > 0 ? array_sum(array_column($reviews, 'rating')) / count($reviews) : 0;
                                        $reviewCount = count($reviews);
                                    }
                                @endphp
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= round($averageRating) ? '' : 'text-muted' }}"></i>
                                @endfor
                            </div>
                            <span class="text-muted">({{ $reviewCount }} đánh giá)</span>
                        </div>
                    </div>

                    <!-- Price -->
                    <div class="mb-4">
                        <h4 class="mb-0">
                            @if($product->giam_gia)
                                <span class="text-decoration-line-through text-muted me-2">{{ number_format($product->gia_san_pham, 0, ',', '.') }} VND</span>
                                <span class="text-danger fw-bold">{{ number_format($product->gia_san_pham - $product->giam_gia, 0, ',', '.') }} VND</span>
                                <span class="badge bg-danger ms-2">Giảm {{ round(($product->giam_gia / $product->gia_san_pham) * 100) }}%</span>
                            @else
                                <span class="fw-bold">{{ number_format($product->gia_san_pham, 0, ',', '.') }} VND</span>
                            @endif
                        </h4>
                    </div>

                    <!-- Product Details -->
                    <div class="mb-4">
                        <div class="row g-3">
                            <div class="col-6 col-lg-4">
                                <p class="mb-1 text-muted">Mã sản phẩm:</p>
                                <p class="fw-medium">{{ $product->ma_san_pham }}</p>
                            </div>
                            <div class="col-6 col-lg-4">
                                <p class="mb-1 text-muted">Danh mục:</p>
                                <p class="fw-medium">{{ $product->category->ten_danh_muc }}</p>
                            </div>
                            <div class="col-6 col-lg-4">
                                <p class="mb-1 text-muted">Trạng thái:</p>
                                @if($product->so_luong > 0)
                                    <p class="fw-medium text-success">Còn hàng ({{ $product->so_luong }} sản phẩm)</p>
                                @else
                                    <p class="fw-medium text-danger">Hết hàng</p>
                                @endif
                            </div>
                            <div class="col-6 col-lg-4">
                                <p class="mb-1 text-muted">Ngày nhập:</p>
                                <p class="fw-medium">{{ \Carbon\Carbon::parse($product->ngay_nhap_kho)->format('d/m/Y') }}</p>
                            </div>
                            <div class="col-6 col-lg-4">
                                <p class="mb-1 text-muted">Bảo hành:</p>
                                <p class="fw-medium">12 tháng</p>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mb-4">
                        <h5 class="fw-bold mb-2">Mô tả sản phẩm</h5>
                        <p class="text-muted">{{ $product->mo_ta }}</p>
                    </div>

                    <!-- Action Buttons -->
                    @if($product->so_luong > 0)
                        <div class="d-flex flex-wrap gap-2">
                            <div class="input-group me-3" style="width: 130px;">
                                <button class="btn btn-outline-secondary" type="button" id="decrementBtn">-</button>
                                <input type="number" class="form-control text-center" value="1" min="1" max="{{ $product->so_luong }}" id="quantity">
                                <button class="btn btn-outline-secondary" type="button" id="incrementBtn">+</button>
                            </div>
                            <button class="btn btn-primary">
                                <i class="fas fa-shopping-cart me-2"></i>Thêm vào giỏ hàng
                            </button>
                            <button class="btn btn-outline-secondary">
                                <i class="far fa-heart me-2"></i>Yêu thích
                            </button>
                        </div>
                    @else
                        <button class="btn btn-secondary disabled">
                            <i class="fas fa-times-circle me-2"></i>Hết hàng
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Tabs for Additional Information -->
    <div class="card border-0 shadow-sm mb-5">
        <div class="card-body">
            <ul class="nav nav-tabs" id="productTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true">Chi tiết</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab" aria-controls="reviews" aria-selected="false">Đánh giá</button>
                </li>
            </ul>
            <div class="tab-content p-4" id="productTabsContent">
                <!-- Description Tab -->
                <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                    <div class="row">
                        <div class="col-md-8">
                            <h4 class="fw-bold mb-3">Thông tin chi tiết</h4>
                            <p>{{ $product->mo_ta }}</p>

                            <!-- Technical specifications -->
                            <div class="mt-4">
                                <h5 class="fw-bold mb-3">Thông số kỹ thuật</h5>
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <th scope="row" class="w-25">Thương hiệu</th>
                                            <td>{{ $product->category->ten_danh_muc }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Mã sản phẩm</th>
                                            <td>{{ $product->ma_san_pham }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Bảo hành</th>
                                            <td>12 tháng</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Ngày nhập kho</th>
                                            <td>{{ \Carbon\Carbon::parse($product->ngay_nhap_kho)->format('d/m/Y') }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Trạng thái</th>
                                            <td>
                                                @if($product->so_luong > 0)
                                                    Còn hàng
                                                @else
                                                    Hết hàng
                                                @endif
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Reviews Tab -->
                <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                    @if(Auth::check())
                        <!-- Write Review Form -->
                        <div class="card mb-4 bg-light border">
                            <div class="card-body">
                                <h5 class="card-title fw-bold mb-3">Viết đánh giá</h5>
                                <form action="{{ route('reviews.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                                    <div class="mb-3">
                                        <label class="form-label fw-medium">Xếp hạng</label>
                                        <div class="rating d-flex gap-3">
                                            @for($i = 5; $i >= 1; $i--)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="rating" id="rating{{ $i }}" value="{{ $i }}" {{ $i == 5 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="rating{{ $i }}">
                                                        @for($j = 1; $j <= $i; $j++)
                                                            <i class="fas fa-star text-warning"></i>
                                                        @endfor
                                                        @for($j = $i + 1; $j <= 5; $j++)
                                                            <i class="fas fa-star text-muted"></i>
                                                        @endfor
                                                    </label>
                                                </div>
                                            @endfor
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="content" class="form-label fw-medium">Nội dung đánh giá</label>
                                        <textarea class="form-control" id="content" name="content" {{ old('content') }} rows="3" required></textarea>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Gửi đánh giá</button>
                                </form>
                            </div>
                        </div>

                        <!-- Reviews List -->
                        @if($reviews->isEmpty())
                            <div class="alert alert-info">Chưa có đánh giá nào. Hãy là người đầu tiên đánh giá sản phẩm này!</div>
                        @else
                            @foreach($reviews as $review)
                                <div class="card mb-3 border">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between mb-2">
                                            <h6 class="card-title fw-bold mb-0">{{ $review->user->name }}</h6>
                                            <div class="text-warning">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fas fa-star {{ $i <= $review->rating ? '' : 'text-muted' }}"></i>
                                                @endfor
                                            </div>
                                        </div>
                                        <p class="card-text">{{ $review->content }}</p>
                                        <div class="text-muted small">{{ $review->created_at->format('d/m/Y') }}</div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    @else
                        <div class="alert alert-warning">
                            <i class="fas fa-info-circle me-2"></i>
                            Vui lòng <a href="{{ route('login') }}" class="alert-link">đăng nhập</a> để xem và viết đánh giá cho sản phẩm này.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Related Products -->
    <section class="mb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold mb-0">Sản phẩm liên quan</h3>
            <a href="{{ route('products.index') }}" class="btn btn-outline-primary btn-sm">Xem tất cả</a>
        </div>

        <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 g-3">
            @foreach($relatedProducts as $relatedProduct)
                <div class="col">
                    <div class="card h-100 border-0 shadow-sm">
                        <a href="{{ route('products.show', $relatedProduct->id) }}" class="text-decoration-none">
                            <img src="{{ asset('storage/' . $relatedProduct->img) }}" class="card-img-top" alt="{{ $relatedProduct->ten_san_pham }}" style="height: 100%; object-fit: cover;">
                        </a>
                        <div class="card-body">
                            <a href="{{ route('products.show', $relatedProduct->id) }}" class="text-decoration-none text-dark">
                                <h6 class="card-title fw-semibold text-truncate">{{ $relatedProduct->ten_san_pham }}</h6>
                            </a>
                            <div class="mt-2">
                                @if($relatedProduct->giam_gia)
                                    <div class="d-flex flex-column">
                                        <span class="text-decoration-line-through text-muted small">{{ number_format($relatedProduct->gia_san_pham, 0, ',', '.') }} VND</span>
                                        <span class="fw-bold text-danger">{{ number_format($relatedProduct->gia_san_pham - $relatedProduct->giam_gia, 0, ',', '.') }} VND</span>
                                    </div>
                                @else
                                    <span class="fw-bold">{{ number_format($relatedProduct->gia_san_pham, 0, ',', '.') }} VND</span>
                                @endif
                            </div>
                        </div>
                        <div class="card-footer bg-white border-0 p-3 pt-0">
                            <div class="d-grid">
                                <a href="{{ route('products.show', $relatedProduct->id) }}" class="btn btn-sm btn-outline-primary">Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Quantity increment/decrement
        const quantityInput = document.getElementById('quantity');
        const incrementBtn = document.getElementById('incrementBtn');
        const decrementBtn = document.getElementById('decrementBtn');

        if (incrementBtn && decrementBtn && quantityInput) {
            incrementBtn.addEventListener('click', function() {
                const maxValue = parseInt(quantityInput.getAttribute('max'));
                const currentValue = parseInt(quantityInput.value);
                if (currentValue < maxValue) {
                    quantityInput.value = currentValue + 1;
                }
            });

            decrementBtn.addEventListener('click', function() {
                const currentValue = parseInt(quantityInput.value);
                if (currentValue > 1) {
                    quantityInput.value = currentValue - 1;
                }
            });
        }
    });
</script>
@endsection

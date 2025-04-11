@extends('layouts.client')

@section('title', 'Trang chủ')

@section('content')
<!-- Banner Slider -->
<div class="row mb-5">
    <div class="col-12">
        <div id="bannerCarousel" class="carousel slide shadow-sm rounded" data-bs-ride="carousel">
            <div class="carousel-inner rounded">
                @foreach($banners as $key => $banner)
                    <div class="carousel-item {{ $key === 0 ? 'active' : '' }}" style="height: 400px;">
                        <a href="{{ $banner->link }}">
                            <img src="{{ asset('storage/' . $banner->anh) }}"
                                 class="d-block w-100 h-100"
                                 alt="{{ $banner->ten_banner }}"
                                 style="object-fit: cover;">
                        </a>
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
            <div class="carousel-indicators">
                @foreach($banners as $key => $banner)
                    <button type="button"
                            data-bs-target="#bannerCarousel"
                            data-bs-slide-to="{{ $key }}"
                            class="{{ $key === 0 ? 'active' : '' }}"
                            aria-current="{{ $key === 0 ? 'true' : 'false' }}"
                            aria-label="Slide {{ $key + 1 }}"></button>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Sản phẩm mới nhất -->
<div class="row mb-5">
    <div class="col-12 mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="fw-bold text-dark">Sản phẩm mới nhất</h2>
            <a href="{{ route('products') }}" class="text-primary text-decoration-none d-flex align-items-center">
                Xem thêm <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>

    <div class="col-12">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            @foreach($latestProducts as $product)
                <div class="col">
                    <div class="card h-100">
                        <div class="position-relative" style="padding-bottom: 133.33%;">
                            <a href="{{ route('products.show', $product->id) }}" class="d-block" onclick="openImageModal('{{ asset('storage/' . $product->img) }}')">
                                <img src="{{ asset('storage/' . $product->img) }}"
                                     class="card-img-top"
                                     alt="{{ $product->ten_san_pham }}"
                                     style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: contain; padding: 16px;">
                            </a>
                        </div>
                        <div class="card-body">
                            <a href="{{ route('products.show', $product->id) }}" class="text-decoration-none">
                                <h5 class="card-title fw-semibold text-dark">{{ $product->ten_san_pham }}</h5>
                            </a>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    @if($product->giam_gia)
                                        <span class="fs-5 fw-bold text-danger">{{ number_format($product->gia_san_pham - $product->giam_gia) }} đ</span>
                                        <span class="text-muted text-decoration-line-through ms-2">{{ number_format($product->gia_san_pham) }} đ</span>
                                    @else
                                        <span class="fs-5 fw-bold" style="color: var(--primary-color)">{{ number_format($product->gia_san_pham) }} đ</span>
                                    @endif
                                </div>
                                @if($product->giam_gia)
                                    <span class="badge bg-danger">
                                        -{{ round(($product->giam_gia / ($product->gia_san_pham - $product->giam_gia)) * 100) }}%
                                    </span>
                                @endif
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <button class="btn btn-primary btn-sm d-flex align-items-center">
                                    <i class="fas fa-shopping-cart me-1"></i> Thêm vào giỏ
                                </button>
                                <button class="btn btn-light btn-sm icon-circle">
                                    <i class="far fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Modal để hiển thị ảnh full màn hình -->
{{-- <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content bg-dark">
            <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body d-flex align-items-center justify-content-center">
                <img id="modalImage" src="" alt="Product Image" class="img-fluid" style="max-height: 90vh;">
            </div>
        </div>
    </div>
</div> --}}

<!-- Bài viết mới nhất -->
<div class="row mb-5">
    <div class="col-12 mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="fw-bold text-dark">Bài viết mới nhất</h2>
            <a href="{{ route('posts') }}" class="text-primary text-decoration-none d-flex align-items-center">
                Xem thêm <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>

    <div class="col-12">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
            @foreach($latestPosts as $post)
                <div class="col">
                    <div class="card h-100">
                        <a href="#">
                            <img src="{{ asset($post->image) }}" class="card-img-top" alt="{{ $post->title }}" style="height: 160px; object-fit: cover;">
                        </a>
                        <div class="card-body">
                            <div class="d-flex align-items-center text-muted mb-2 small">
                                <i class="far fa-calendar-alt me-2"></i>
                                {{ $post->created_at }}
                                <span class="mx-2">|</span>
                                <span class="badge" style="background-color: rgba(99, 102, 241, 0.1); color: var(--primary-color);">
                                    {{ $post->category->ten_danh_muc }}
                                </span>
                            </div>
                            <a href="#" class="text-decoration-none">
                                <h5 class="card-title fw-semibold text-dark">{{ $post->title }}</h5>
                            </a>
                            <p class="card-text text-muted small" style="overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                                {{ \Illuminate\Support\Str::limit(strip_tags($post->content), 100) }}
                            </p>
                            <a href="#" class="text-primary text-decoration-none d-flex align-items-center small">
                                Đọc thêm <i class="fas fa-long-arrow-alt-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Đánh giá từ khách hàng -->
<div class="row mb-5">
    <div class="col-12 mb-4">
        <h2 class="fw-bold text-dark">Đánh giá từ khách hàng</h2>
    </div>

    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <div class="row row-cols-1 row-cols-md-2 g-4">
                    @foreach($topReviews as $review)
                        <div class="col">
                            <div class="border-bottom pb-3 mb-3 @if($loop->last) border-0 pb-0 mb-0 @endif">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <div>
                                        <h5 class="fw-semibold">{{ $review->name }}</h5>
                                        <div class="text-warning">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= $review->rating)
                                                    <i class="fas fa-star"></i>
                                                @else
                                                    <i class="far fa-star"></i>
                                                @endif
                                            @endfor
                                        </div>
                                    </div>
                                    <span class="text-muted small">{{ $review->created_at }}</span>
                                </div>
                                <p class="text-muted mb-0">{{ \Illuminate\Support\Str::limit($review->content, 150) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .carousel {
        border-radius: 0.5rem;
        overflow: hidden;
    }

    /* Áp dụng hiệu ứng hover từ layout chính */
    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: none;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 15px rgba(0,0,0,0.1);
    }

    /* Chỉnh sửa nút yêu thích theo định dạng icon-circle */
    .btn.icon-circle {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        padding: 0;
        background-color: rgba(99, 102, 241, 0.1);
        color: var(--primary-color);
        transition: all 0.3s ease;
    }

    .btn.icon-circle:hover {
        background-color: var(--primary-color);
        color: white;
    }

    /* Chỉnh sửa style cho các hạng mục khác phù hợp với layout */
    .text-primary {
        color: var(--primary-color) !important;
    }

    .btn-primary {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }

    .btn-primary:hover {
        background-color: var(--primary-dark);
        border-color: var(--primary-dark);
    }
</style>
@endsection

@section('scripts')
<script>
    // JavaScript để xử lý modal ảnh
    function openImageModal(imageSrc) {
        const modalImage = document.getElementById('modalImage');
        modalImage.src = imageSrc;
        const imageModal = new bootstrap.Modal(document.getElementById('imageModal'));
        imageModal.show();
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Khởi tạo carousel
        const myCarousel = new bootstrap.Carousel(document.getElementById('bannerCarousel'), {
            interval: 5000,
            wrap: true
        });
    });
</script>
@endsection

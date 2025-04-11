
@extends('layouts.client')
@section('title', $post->title)
@section('content')
<body>
    <div class="container my-5">
        <h1 class="mb-4">{{ $post->title }}</h1>

        <div class="row">
            <div class="col-md-8">
                <!-- Hình ảnh -->
                @if ($post->image)
                    <img src="{{ asset($post->image) }}" class="img-fluid mb-3" alt="{{ $post->title }}" style="max-height: 400px; object-fit: cover;">
                @else
                    <img src="https://via.placeholder.com/800x400" class="img-fluid mb-3" alt="Không có ảnh" style="max-height: 400px; object-fit: cover;">
                @endif

                <!-- Nội dung -->
                <div class="content">
                    {!! nl2br(e($post->content)) !!}
                </div>
            </div>

            <div class="col-md-4">
                <!-- Thông tin -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Thông tin bài viết</h5>
                        <p><strong>Danh mục:</strong> {{ $post->category->ten_danh_muc }}</p>
                        <p><strong>Ngày đăng:</strong> {{ $post->created_at->format('d/m/Y H:i') }}</p>
                        <p><strong>Cập nhật:</strong> {{ $post->updated_at->format('d/m/Y H:i') }}</p>
                        <a href="{{ route('posts') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Quay lại danh sách
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách bài viết</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h1 class="mb-4">Danh sách bài viết</h1>

        <!-- Form tìm kiếm -->
        <form method="GET" action="{{ route('posts') }}" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Tìm kiếm bài viết..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Tìm</button>
            </div>
        </form>

        <!-- Danh sách bài viết -->
        <div class="row">
            @forelse ($posts as $post)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        @if ($post->image)
                            <img src="{{ asset($post->image) }}" class="card-img-top" alt="{{ $post->title }}" style="height: 200px; object-fit: cover;">
                        @else
                            <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="No image" style="height: 200px; object-fit: cover;">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text">{{ Str::limit($post->content, 100) }}</p>
                            <p class="text-muted small">Danh mục: {{ $post->category->ten_danh_muc }}</p>
                            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary">Xem chi tiết</a>
                        </div>
                        <div class="card-footer text-muted">
                            <small>Đăng ngày: {{ $post->created_at->format('d/m/Y') }}</small>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-center">Không có bài viết nào.</p>
                </div>
            @endforelse
        </div>

        <!-- Phân trang -->
        <div class="d-flex justify-content-center">
            {{ $posts->links() }}
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

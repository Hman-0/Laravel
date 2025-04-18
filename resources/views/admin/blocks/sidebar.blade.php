<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sidebar Bootstrap</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: gray;
            padding-top: 20px;
        }
        .sidebar .nav-link {
            color: #fff;
            padding: 10px 15px;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background: #6c757d;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link active" href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2"></i> Dashboard</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.products.index') }}"><i class="bi bi-box"></i> Products</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.categories.index') }}"><i class="bi bi-envelope"></i> Category</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.banners.index') }}"><i class="bi bi-people"></i> Banner</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.posts.index') }}"><i class="bi bi-box-seam"></i> Post</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.contacts.index') }}"><i class="bi bi-box-seam"></i> Contact</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.reviews.index') }}"><i class="bi bi-box-seam"></i> Review</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.customers.index') }}"><i class="bi bi-box-seam"></i> Customer</a>
        </li>
    </ul>
    <div class="sidebar-footer text-center py-3">
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button class="btn btn-danger w-100" type="submit">Logout</button>
    </form>
        </a>
    </div>
</div>

</body>
</html>


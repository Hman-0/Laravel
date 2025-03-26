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
            background: gray;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <ul class="nav flex-column"><br>
        <br>
        <li class="nav-item">
            <a class="nav-link active" href="{{route('admin.dashboard')}}"><i class="bi bi-speedometer2"></i> Dashboard</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.products.index')}}"><i class="bi bi-box"></i> Products</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.categories.index')}}"><i class="bi bi-envelope"></i> Category    </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.banners.index')}}"><i class="bi bi-people"></i> Banner </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#"><i class="bi bi-box-seam"></i> Orders</a>
        </li>
        <li>
             <div class="sidebar-footer text-center py-3">
        <a href="#" class="btn btn-danger w-75">
            <i class="fas fa-sign-out-alt me-2"></i> Đăng xuất
        </a>
    </div>
        </li>
    </ul>
   
</div>

</body>
</html>

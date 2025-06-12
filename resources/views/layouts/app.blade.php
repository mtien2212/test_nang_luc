<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ứng dụng Quản lý</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
    <div class="container">
        <a class="navbar-brand" href="">Test năng lực</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                @auth
                <li class="nav-item">
                    <form method="POST" action="/logout">
                        @csrf
                        <button class="btn btn-link nav-link" type="submit">Đăng xuất</button>
                    </form>
                </li>
                @else
                <li class="nav-item"><a class="nav-link" href="/">Đăng nhập</a></li>
                <li class="nav-item"><a class="nav-link" href="/register">Đăng ký</a></li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
<main>
    @yield('content')
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

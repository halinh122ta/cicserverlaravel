<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/login.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Đăng nhập Nttbchecker.vn</title>
</head>
<body>
    <form class="form" action="{{ route('loginPost') }}" method="POST">
        <div class="form-class">
            {{ csrf_field() }}
            <div class="mb-3 mt-3">
                <h1><span><img height="40px" src="{{ asset('./assets/img/logo.jpg') }}" alt=""></span> <span>Nttbchecker.vn</span></h1>
            </div>
            <label for="">CÔNG CỤ TÌM KIẾM NHỮNG GÌ BẠN CẦN TRONG TÀI CHÍNH</label>
            <div class="mb-3 mt-3">
                <label for="phone" class="form-label">Số điện thoại:</label>
                <input type="text" class="form-control" id="phone" placeholder="Số điện thoại..." name="phonenumber">
            </div>
            <div class="mb-3">
                <label for="pwd" class="form-label">Mật khẩu:</label>
                <input type="password" class="form-control" id="pwd" placeholder="Mật khẩu..." name="password">
            </div>
            <div class="form-check mb-3">
                <label class="form-check-label">
                <input class="form-check-input" type="checkbox" name="remember"> Nhớ tài khoản
                </label>
            </div>
            <div class="form-check mb-3">
                <button type="submit" style="margin: 2px;" class="btn btn-primary">Đăng nhập</button>
                <a href="/register" style="margin: 2px;" class="btn btn-primary">Đăng ký</a href="/register">
            </div>
        </div>
    </form>
<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
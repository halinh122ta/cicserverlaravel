<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/login.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('./assets/css/sweetalert2.min.css') }}">
    
    <title>Đăng nhập Nttbchecker.vn</title>
</head>
<body>
    <form class="form" action="{{ route('registerPost') }}" method="POST">
        <div class="form-class">
            {{ csrf_field() }}
            <div class="mb-3 mt-3">
                <h1><span><img height="40px" src="{{ asset('./assets/img/logo.jpg') }}" alt=""></span><span>Nttbchecker.vn</span></h1>
            </div>
            <div class="mb-3 mt-3">
                <label for="Phone" class="form-label">Tên khách hàng:</label>
                <input type="text" class="form-control" name="name" placeholder="Tên khách hàng...">
            </div>
            <div class="mb-3 mt-3">
                <label for="Phone" class="form-label">Số điện thoại:</label>
                <input type="text" class="form-control" name="phonenumber" placeholder="Số điện thoại...">
            </div>
            <div class="mb-3">
                <label for="pwd" class="form-label">Mật khẩu:</label>
                <input type="password" class="form-control" name="password" placeholder="Mật khẩu...">
            </div>
            <div class="mb-3">
                <label for="pwd" class="form-label">Nhắc lại mật khẩu:</label>
                <input type="password" class="form-control" name="re_password" placeholder="Nhắc lại mật khẩu...">
            </div>
            <div class="mb-3">
                <label for="pwd" class="form-label">Khu vực:</label>
                <select class="form-control" name="provinceSelect" id="provinceSelect">
                    <option>Khu vực</option>
                </select>
            </div>
            <div class="form-check mb-3">
                <button style="margin: 2px;" type="submit" class="btn btn-primary register">Đăng ký</button>
            </div>
        </div>
    </form>
    <script>
        const khuvuc = () =>{
            var vietnamProvinces = ["An Giang", "Bà Rịa - Vũng Tàu", "Bắc Giang", "Bắc Kạn", "Bạc Liêu", "Bắc Ninh", "Bến Tre", "Bình Định", "Bình Dương", "Bình Phước", "Bình Thuận", "Cà Mau", "Cao Bằng", "Đắk Lắk", "Đắk Nông", "Điện Biên", "Đồng Nai", "Đồng Tháp", "Gia Lai", "Hà Giang", "Hà Nam", "Hà Tĩnh", "Hải Dương", "Hậu Giang", "Hòa Bình", "Hưng Yên", "Khánh Hòa", "Kiên Giang", "Kon Tum", "Lai Châu", "Lâm Đồng", "Lạng Sơn", "Lào Cai", "Long An", "Nam Định", "Nghệ An", "Ninh Bình", "Ninh Thuận", "Phú Thọ", "Quảng Bình", "Quảng Nam", "Quảng Ngãi", "Quảng Ninh", "Quảng Trị", "Sóc Trăng", "Sơn La", "Tây Ninh", "Thái Bình", "Thái Nguyên", "Thanh Hóa", "Thừa Thiên Huế", "Tiền Giang", "Trà Vinh", "Tuyên Quang", "Vĩnh Long", "Vĩnh Phúc", "Yên Bái", "Phú Yên", "Cần Thơ", "Đà Nẵng", "Hải Phòng", "Hà Nội", "TP HCM"];

                var selectElement = document.getElementById("provinceSelect"); // Replace "provinceSelect" with the ID of your select element
                for (var i = 0; i < vietnamProvinces.length; i++) {
                var option = document.createElement("option");
                option.value = vietnamProvinces[i];
                option.textContent = vietnamProvinces[i];
                selectElement.appendChild(option);
            }
        }
        khuvuc()
        // 
    </script>
    <script src="{{ asset('./assets/css/sweetalert2.all.min.js') }}"></script>
    <script src=""></script>
<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
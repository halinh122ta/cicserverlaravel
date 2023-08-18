<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/home.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
    <script src="../assets/js/axios.min.js"></script>
    <script src="../assets/js/FileSaver.min.js"></script>
    <link href="{{ asset('./assets/img/logo.jpg') }}" rel="icon">
    <link rel="stylesheet" href="./assets/css/sweetalert2.min.css">
    <script src="./assets/js/sweetalert2.all.min.js"></script>
    <title>Trang chủ</title>
</head>
<body>
    <div id="viewport">
        <!-- Sidebar -->
        <div id="sidebar">
          <header>
            <a href="/" id="top"><img style="width:35px;" src="{{ asset('./assets/img/logo.jpg') }}"> Nttbchecker.vn</a>
          </header>
          <ul class="nav">
            <li>
              <a href="./home">
                <i class="zmdi zmdi-view-dashboard"></i> Kiểm tra CIC
              </a>
            </li>
            <li>
              <a href="./bank">
                <i class="zmdi zmdi-view-dashboard"></i> Nạp bit tự động
              </a>
            </li>
            @if ($user->role == 1)
              <li>
                <a href="./person">
                  <i class="zmdi zmdi-view-dashboard"></i> Người dùng
                </a>
              </li>
              <li>
                <a href="./price">
                  <i class="zmdi zmdi-view-dashboard"></i> Cài đặt giá
                </a>
              </li>
              <li>
                <a href="./bit">
                  <i class="zmdi zmdi-view-dashboard"></i> Danh sách chờ
                </a>
              </li>
            @endif
            <li>
              <a href="./history">
                <i class="zmdi zmdi-view-dashboard"></i> Lịch sử giao dịch
              </a>
            </li>
            <li>
              <a href="./history">
                <i class="zmdi zmdi-view-dashboard"></i> Cá nhân (<span id="balance">{{ $user->balance }}</span> bit)
              </a>
            </li>
            <li>
              <a class="logout" href="./logout" style="cursor: pointer;">
                <i class="zmdi zmdi-view-dashboard"></i> Đăng xuất
              </a>
            </li>
          </ul>
        </div>
        <!-- Content -->
        <div id="content">
            @yield('content')
        </div>
      <style>
        #top{
            background-color: #201f1f;
        }
        #sidebar{
            background-color: #263238;
        }
        .main-pop{
          position: fixed;
          width:100%;
          top:0;
          left:0;
          min-height:100vh;
          z-index: 9999;
          display: none;
        }
        .main-pop .show{
          display: block;
        }
        .flex{
          display: flex;
        }
        .btn-close{
          margin-left: auto;
        }
        .input-group{
          margin-bottom: 10px;
          width: 100%;
        }
        .input-group input{
          width: 100%;
        }
      </style>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('./assets/js/apply.min.js') }}"></script>
</body>
</html>
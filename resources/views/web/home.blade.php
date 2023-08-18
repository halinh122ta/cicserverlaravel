@extends('app')
@section('content')
<div class="container-fluid">
  <div class="content-table" style="padding: 10px">
    <div class="row">
        <h2>Check CIC - DUP</h2>
        <a class="btn btn-info" href="/bank">Nạp bit</a>
        <br>
    </div>
    <div class="row">
      <h3 style="margin:10px;margin-left:0px;">Xin chào {{ $user->name }}</h3>
    </div>
      <div class="row">
        <br>
        <div class="col col-6 mb-3">
          <label for="id_person" class="form-label">CMND | CCCD:</label>
          <input type="text" class="form-control" id="id_person" placeholder="CMND | CCCD">
        </div>
        <br>
        <div class="col col-6 mb-3">
          <label for="name" class="form-label">Họ và Tên:</label>
          <input type="text" class="form-control" id="name" placeholder="Họ và Tên">
        </div>
      </div>
      <div class="row">
        <br>
        <button type="button" class="btn btn-primary check_full">Kiểm tra Full</button>
      </div>
      <style>
        .btn-outline{
          max-width:200px;
          margin-right:3px;
          border: 1px solid gray
        }
      </style>
      <h3>Kiểm tra DUPLICATE</h3>
      <div class="row">
        <button type="button" class="btn btn-outline btn-outline-success mt-3 Ebanker">Mirae</button>
        <button type="button" class="btn btn-outline btn-outline-info mt-3 Fig">Mcredit</button>
        <button type="button" class="btn btn-outline btn-outline-warning mt-3 CicShb">SHB</button>
        <button type="button" class="btn btn-outline btn-outline-danger mt-3 Ptf">PTF</button>
        <button type="button" class="btn btn-outline btn-outline-dark mt-3 LotteFinance">Lotte</button>
      </div><br>
      <div class="row" >
        <h4>Kết quả sẽ hiển thị ở đây: </h4>
        <br>
        <div class="result">
            <div class="show" id="result">
              
            </div>
        </div>
      </div>
  </div>
</div>
<div class="loading">
  <span class="loader"></span>
</div>
<style>
  .loading{
    position: fixed;
    top: 0;
    background-color: #3f3f3f5b;
    width: 100%;
    height: 100vh;
    display: none;
  }
  .loader {
        margin: auto;
        align-items: center
        transform: rotateZ(45deg);
        perspective: 1000px;
        border-radius: 50%;
        width: 48px;
        height: 48px;
        color: #fff;
      }
        .loader:before,
        .loader:after {
          content: '';
          display: block;
          position: absolute;
          top: 0;
          left: 0;
          width: inherit;
          height: inherit;
          border-radius: 50%;
          transform: rotateX(70deg);
          animation: 1s spin linear infinite;
        }
        .loader:after {
          color: #FF3D00;
          transform: rotateY(70deg);
          animation-delay: .4s;
        }

      @keyframes rotate {
        0% {
          transform: translate(-50%, -50%) rotateZ(0deg);
        }
        100% {
          transform: translate(-50%, -50%) rotateZ(360deg);
        }
      }

      @keyframes rotateccw {
        0% {
          transform: translate(-50%, -50%) rotate(0deg);
        }
        100% {
          transform: translate(-50%, -50%) rotate(-360deg);
        }
      }

      @keyframes spin {
        0%,
        100% {
          box-shadow: .2em 0px 0 0px currentcolor;
        }
        12% {
          box-shadow: .2em .2em 0 0 currentcolor;
        }
        25% {
          box-shadow: 0 .2em 0 0px currentcolor;
        }
        37% {
          box-shadow: -.2em .2em 0 0 currentcolor;
        }
        50% {
          box-shadow: -.2em 0 0 0 currentcolor;
        }
        62% {
          box-shadow: -.2em -.2em 0 0 currentcolor;
        }
        75% {
          box-shadow: 0px -.2em 0 0 currentcolor;
        }
        87% {
          box-shadow: .2em -.2em 0 0 currentcolor;
        }
      }
   
</style>
@endsection
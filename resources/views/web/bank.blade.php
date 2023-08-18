@extends('app')
@section('content')
<div class="container-fluid">
    <div class="content-table" style="padding: 10px">
        <div class="bank">
            <div class="bank-content">
              <h5 class="title">
                Nạp tiền vào tài khoản
              </h5>
              <input type="text" hidden value="{{ $set->bank_number }}" id="bank_number">
              <input type="text" hidden value="{{ $set->bank }}" id="bank">
              <p>TÊN TÀI KHOẢN: <span style="text-transform: uppercase">{{ $set->name }}</span></p>
              <p style="margin-bottom: 15px;">SỐ TÀI KHOẢN: {{ $set->bank_number }} - <span style="text-transform: uppercase">{{ $set->bank }}</span></p>
              <div class="input-gr">
                <div>
                  <p>Số tiền cần nạp</p>
                </div>
                <input type="text" value="50000" id="bank_money" min="50000">
              </div>
              <div class="input-gr">
                <p class="pay_content">Nội dung chuyển khoản: <span class="bank_infoadd">nt{{ $user->phonenumber }}</span></p>
              </div>
              <div class="input-gr">
                <button class="btn btn-outline-info create_qr">TẠO QR NẠP</button>
              </div>
              <div class="image_bank">
                <!-- <img width="400" height="400" src="https://img.vietqr.io/image/vietinbank-108867592530-compact2.jpg?amount=50000&addInfo=xinchao" alt="qr chuyển khoản"> -->
              </div>
              <div class="load_bank">
                <img src="{{ asset('assets/img/Loading_2.gif') }}" width="30" height="30"> <span style="font-size: 13px;"
                  class="transaction_note">Chọn "TẠO QR NẠP" để tạo hóa đơn</span>
              </div>
            </div>
          </div>
    </div>
    <script>
        var create_qr = document.querySelector('.create_qr');
        create_qr.addEventListener('click', () => {
            var money = document.querySelector('#bank_money')
            var bank = document.querySelector('#bank')
            var bank_number = document.querySelector('#bank_number')

            var bank_infoadd = document.querySelector('.bank_infoadd')
            var img = document.createElement('img')
            img.width = 300
            img.src = `https://img.vietqr.io/image/${bank.value.toLowerCase()}-${bank_number.value}-compact2.jpg?amount=${money.value}&addInfo=${bank_infoadd.textContent}`
            document.getElementsByClassName('image_bank')[0].innerHTML = ""
            document.getElementsByClassName('image_bank')[0].appendChild(img)
            var p = document.createElement('p')
            const formattedNumber = new Intl.NumberFormat('vi-VN', {
                style: 'currency',
                currency: 'VND'
            }).format(money.value);
            console.log(formattedNumber)
            p.innerHTML = `<span> Chuyển khoản: <span style='color: blue;'>${formattedNumber}</span>. Nội dung: <span style='color: blue;'>${bank_infoadd.textContent}</span></span>`
            document.getElementsByClassName('image_bank')[0].appendChild(p)
            // 
            document.querySelector('.transaction_note').textContent = " Giao dịch sẽ được xử lý sau ít phút!";
            createBill()
        })
        const createBill = async ()=>{
            var money = document.querySelector('#bank_money')
            var bank_infoadd = document.querySelector('.bank_infoadd')
            var requestOptions = {
              method: 'GET',
              redirect: 'follow'
            };

            var data =await fetch(`/create?voly=${money.value}&notify=${bank_infoadd.textContent}`, requestOptions)
        }
    </script>
    <style>
        .container-fluid{

        }
        /* Bank */
        .bank{
            width: 100%;
            min-height: 100%;
            color: black
        }
        .bank-content{
            width: 360px;
            margin-top: 1%;
            text-align: center;
            padding: 10px;
            padding-top: 30px;
            position: relative;
            background-color: rgb(104, 104, 255);
            border-radius: 10px;
            color: aliceblue
        }
        .bank-content p{
        font-size: 0.8em;
        padding: 0;
        margin: 0;
        }
        .show_bank{
            display: block;
        }
        .close-bank{
            text-align: end;
            position: absolute;
            top: 0;
            right: 10px;
        }
        .close-bank a{
            color: red;
            font-size: 20px;
            cursor: pointer;
            text-decoration: none;
        }
        .bank .input-group{
            text-align: center;
        }
        input{
            
            color: black;
        }
        #bank_money{
            width: 150px;
            font-size: 16px;
            padding: 2px 10px;
            border: 1px solid rgba(128, 128, 128, 0.24);
        }
        .bank_infoadd{
            color: blue;
        }
        .pay_content{
            padding: 4px 0px !important;
        }
    </style>
  </div>
@endsection
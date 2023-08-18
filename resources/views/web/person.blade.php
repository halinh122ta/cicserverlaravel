@extends('app')
@section('content')
<div class="container-fluid">
    <div class="content-table">
        <h3>Danh sách người dùng <span class="count"></span></h3>
        <table class="table table-bordered border-primary" style="width: 100%;overflow-x: scroll;">
            <thead>
                <th scope="row" style="width:70px;">STT</th>
                <th scope="row">Tên tài khoản</th>
                <th scope="row">Số điện thoại</th>
                <th scope="row">Số dư</th>
                <th scope="row" style="text-align: center;">Edit</th>
            </thead>
            <tbody class="table-content">
                @foreach ($users as $key => $item)
                    <tr>
                        <td>{{ $key }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->phonenumber }}</td>
                        <td>{{ $item->balance }}</td>
                        <td><button>Xóa</button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
            <div class="btn-group me-2 page-content" role="group" aria-label="First group">
            </div>
        </div>
    </div>   
</div>
@endsection
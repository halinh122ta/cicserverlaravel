@extends('app')
@section('content')
<div class="container-fluid">
    <div class="content-table">
        <h3>Chỉnh sửa</h3>
        <div>
            <div class="mb-3 mt-3">
                <label for="phonenumber" class="form-label">Phonenumber:</label>
                <input type="text" class="form-control" id="Phonenumber" placeholder="Phonenumber" name="Phonenumber">
            </div>
            <label for="name" id="name" class="form-label">Hoàn Nam</label>
            <input type="text" hidden id="id">
            <div class="mb-3">
                <label for="balance" class="form-label">Số dư:</label>
                <input type="text" class="form-control" id="balance" placeholder="Số dư" name="balance">
            </div>
            <div class="mb-3">
                <label for="balance" class="form-label">Biến động( + hoặc - vào số dư):</label>
                <input type="text" class="form-control" id="balance" placeholder="Biến động( + hoặc - vào số dư)" name="balance">
            </div>
            <button type="submit" class="btn btn-primary">Chỉnh sửa</button>
        </div>
        <h3>Danh sách chờ<span class="count"></span></h3>
        <table class="table table-bordered border-primary" style="width: 100%;overflow-x: scroll;">
            <thead>
                <th scope="row" style="width:70px;">STT</th>
                <th scope="row">Tên tài khoản</th>
                <th scope="row">Biến động</th>
                <th scope="row">Chi chú</th>
                <th scope="row">Thời gian</th>
                <th scope="row" style="">Edit</th>
            </thead>
            <tbody class="table-content">
                @foreach ($appvo as $key => $item)
                    <tr data-id="{{ $item->id }}">
                        <td>{{ $key }}</td>
                        <td>USER_ID: {{ $item->id_user }}</td>
                        <td>{{ $item->volatility }}</td>
                        <td>{{ $item->notify }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>
                            <button type="button" class="btn btn-success apply">Phê duyệt</button>
                            <button type="button" class="btn btn-danger cancel" >Hủy</button>
                        </td>
                    </tr>   
                @endforeach
            </tbody>
        </table>
        <h3>Lịch sử nạp<span class="count"></span></h3>
        <table class="table table-bordered border-primary" style="width: 100%;overflow-x: scroll;">
            <thead>
                <th scope="row" style="width:70px;">STT</th>
                <th scope="row">Tên tài khoản</th>
                <th scope="row">Biến động</th>
                <th scope="row">Chi chú</th>
                <th scope="row">Thời gian</th>
                <th scope="row" style="">Trạng thái</th>
            </thead>
            <tbody class="table-content">
                @foreach ($appvoAll as $key => $item)
                    <tr>
                        <td>{{ $key }}</td>
                        <td>USER_ID: {{ $item->id_user }}</td>
                        <td>{{ $item->volatility }}</td>
                        <td>{{ $item->notify }}</td>
                        <td>{{ $item->created_at }}</td>
                    @if ($item->status == 1)
                        <td>Done</td>
                    @else
                        @if ($item->status == 0)
                            <td>No</td>
                        @else
                            <td>Deny</td>
                        @endif
                    @endif
                    </tr>   
                @endforeach
            </tbody>
        </table>
    </div>   
</div>
@endsection
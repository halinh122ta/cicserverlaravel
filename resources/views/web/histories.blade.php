@extends('app')
@section('content')
<div class="container-fluid">
    <div class="content-table">
        <h3>Lịch sử giao dịch<span class="count"></span></h3>
        <table class="table table-bordered border-primary" style="width: 100%;overflow-x: scroll;">
            <thead>
                <th scope="row" style="width:70px;">STT</th>
                <th scope="row">Biến động</th>
                <th scope="row">Số dư tại thời điểm</th>
                <th scope="row">Nội dung</th>
            </thead>
            <tbody class="table-content">
                @foreach ($histories as $key => $item)
                    <tr>
                        <td>{{ $key }}</td>
                        <td>{{ $item->balance_change }}</td>
                        <td>{{ $item->balance_stay }}</td>
                        <td>{{ $item->content }}</td>
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
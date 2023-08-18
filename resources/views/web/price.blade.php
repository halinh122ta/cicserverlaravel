@extends('app')
@section('content')
<div class="container-fluid">
    <h3>Bảng lưu thông tin</h3>
    <form class="content-table" style="padding: 10px" action="{{ route('price.savePrice') }}" method="POST">
        
        {{ csrf_field() }}
        <div class="input-group">
            <span class="input-group-text">Giá kiểm tra Full</span>
            <input type="number" style="margin-bottom: 5px;" class="form-control" name="full" value="{{ $set->full }}">
        </div>
        <div class="input-group">
            <span class="input-group-text">Giá từng phẩn</span>
            <input type="number" style="margin-bottom: 5px;" class="form-control" name="odd" value="{{ $set->odd }}">
        </div>
        <h4>Lưu thông tin nạp</h4>
        <div class="input-group">
            <span class="input-group-text">Tên tài khoản</span>
            <input type="text" style="margin-bottom: 5px;" class="form-control" name="name" value="{{ $set->name }}">
        </div>
        <div class="input-group">
            <span class="input-group-text">Số tài khoản</span>
            <input type="text" style="margin-bottom: 5px;" class="form-control" name="bank_number" value="{{ $set->bank_number }}">
        </div>
        <div class="input-group">
            <span class="input-group-text">Ngân hàng</span>
            <input type="text" style="margin-bottom: 5px;" class="form-control" name="bank" value="{{ $set->bank }}">
        </div>
        <div class="input-group">
            <span class="input-group-text">Danh sách cookie</span>
            <textarea id="coke" cols="100" rows="10" class="form-control" style="white-space: nowrap;" name="coke">{{ $set->coke }}</textarea>
        </div>
        <div class="input-group">
            <button type="submit" class="btn btn-info">Lưu thông tin</button>
        </div>
    </form>
</div>
<style>
</style>
@endsection
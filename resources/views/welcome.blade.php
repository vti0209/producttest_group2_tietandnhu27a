@extends('layouts.master')

@section('title', 'Trang chủ')

@section('content')
<div class="welcome-container">
    <div class="welcome-box">
        <h1>Hello Vanw Tít</h1>
        <p class="success-msg">Bạn đã kết nối thành công!</p>

        <hr class="divider">

        <div class="quick-links">
            <p>Bắt đầu quản lý hệ thống tại đây:</p>
            <div class="button-group">
                <a href="{{ route('products.index') }}" class="btn-main">Quản lý Sản phẩm</a>
                <a href="{{ route('users.index') }}" class="btn-outline">Quản lý Người dùng</a>
            </div>
        </div>
    </div>
</div>
@endsection

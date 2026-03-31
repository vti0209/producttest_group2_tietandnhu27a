@extends('layouts.master')

@section('title', 'Đăng ký tài khoản')

@section('content')
<div class="auth-card">
    <h2 class="auth-title">Đăng ký</h2>

    {{-- Hiển thị lỗi nếu đăng ký thất bại --}}
    @if(session('error'))
        <div class="alert alert-error">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('register') }}" method="POST"> //Gửi dữ liệu bằng phương thức POST đến route register
        @csrf

        <div class="form-group">
            <label class="form-label">Tên đăng nhập:</label>
            <input type="text" name="username" required class="input-full" value="{{ old('username') }}">
        </div>

        <div class="form-group">
            <label class="form-label">Họ và tên:</label>
            <input type="text" name="fullname" required class="input-full" value="{{ old('fullname') }}">
        </div>

        <div class="form-group">
            <label class="form-label">Email:</label>
            <input type="email" name="email" required class="input-full" value="{{ old('email') }}">
        </div>

        <div class="form-group">
            <label class="form-label">Mật khẩu:</label>
            <input type="password" name="password" required class="input-full">
        </div>

        <button type="submit" class="btn-register">
            Đăng ký ngay
        </button>
    </form>

    <div class="auth-footer">
        <span>Đã có tài khoản?</span>
        <a href="{{ route('login') }}" class="link-login">Đăng nhập</a>
    </div>
</div>
@endsection

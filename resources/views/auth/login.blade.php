@extends('layouts.master')

@section('title', 'Đăng nhập')

@section('content')
<div class="auth-card">
    <h2 class="auth-title">Đăng nhập</h2>

    {{-- Hiển thị thông báo thành công từ trang Register chuyển sang --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Hiển thị lỗi nếu đăng nhập thất bại --}}
    @if(session('error'))
        <div class="alert alert-error">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('login') }}" method="POST">
        @csrf

        <div class="form-group">
            <label class="form-label">Tên đăng nhập:</label>
            <input type="text" name="username" required
                   class="input-full"
                   placeholder="Nhập username..."
                   value="{{ old('username') }}"> //Giữ lại tên đăng nhập người dùng đã nhập nếu có lỗi xảy ra, giúp người dùng không phải nhập lại từ đầu.
        </div>

        <div class="form-group">
            <label class="form-label">Mật khẩu:</label>
            <input type="password" name="password" required
                   class="input-full"
                   placeholder="Nhập mật khẩu...">
        </div>

        <button type="submit" class="btn-login">
            Đăng nhập
        </button>
    </form>

    <div class="auth-footer">
        <span>Chưa có tài khoản?</span>
        <a href="{{ route('register') }}" class="link-register">Đăng ký ngay</a>
    </div>
</div>
@endsection

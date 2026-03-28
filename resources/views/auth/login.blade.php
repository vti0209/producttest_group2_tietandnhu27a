@extends('layouts.master')

@section('title', 'Đăng nhập')

@section('content')
<div style="max-width: 400px; margin: 80px auto; padding: 25px; border: 1px solid #ddd; border-radius: 10px; background-color: #fff; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
    <h2 style="text-align: center; color: #333; margin-bottom: 20px;">Đăng nhập hệ thống</h2>

    {{-- Hiển thị thông báo thành công từ trang Register chuyển sang --}}
    @if(session('success'))
        <div style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 15px; text-align: center; border: 1px solid #c3e6cb;">
            {{ session('success') }}
        </div>
    @endif

    {{-- Hiển thị lỗi nếu đăng nhập thất bại --}}
    @if(session('error'))
        <div style="background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 15px; text-align: center; border: 1px solid #f5c6cb;">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('login') }}" method="POST">
        @csrf

        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Tên đăng nhập:</label>
            <input type="text" name="username" required
                   style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box;"
                   placeholder="Nhập username..."
                   value="{{ old('username') }}">
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Mật khẩu:</label>
            <input type="password" name="password" required
                   style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box;"
                   placeholder="Nhập mật khẩu...">
        </div>

        <button type="submit"
                style="width: 100%; padding: 12px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; font-weight: bold;">
            Đăng nhập
        </button>
    </form>

    <div style="margin-top: 20px; text-align: center; border-top: 1px solid #eee; padding-top: 15px;">
        <span>Chưa có tài khoản?</span>
        <a href="{{ route('register') }}" style="color: #28a745; text-decoration: none; font-weight: bold;">Đăng ký ngay</a>
    </div>
</div>
@endsection

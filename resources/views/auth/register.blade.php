@extends('layouts.master')

@section('title', 'Đăng ký tài khoản')

@section('content')
<div style="max-width: 400px; margin: 50px auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px; background-color: #fff; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
    <h2 style="text-align: center; color: #333;">Đăng ký hệ thống</h2>

    @if(session('error'))
        <div style="color: red; margin-bottom: 15px; text-align: center;">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('register') }}" method="POST">
        @csrf

        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px;">Tên đăng nhập (Username):</label>
            <input type="text" name="username" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;" value="{{ old('username') }}">
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px;">Họ và tên (Fullname):</label>
            <input type="text" name="fullname" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;" value="{{ old('fullname') }}">
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px;">Email:</label>
            <input type="email" name="email" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;" value="{{ old('email') }}">
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 5px;">Mật khẩu:</label>
            <input type="password" name="password" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
        </div>

        <button type="submit" style="width: 100%; padding: 10px; background-color: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 16px;">
            Đăng ký ngay
        </button>
    </form>

    <div style="margin-top: 15px; text-align: center;">
        <span>Đã có tài khoản?</span>
        <a href="{{ route('login') }}" style="color: #007bff; text-decoration: none;">Đăng nhập</a>
    </div>
</div>
@endsection

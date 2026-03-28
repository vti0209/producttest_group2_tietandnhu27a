@extends('layouts.master')

@section('title', 'Thêm User mới')

@section('content')
<div class="container form-container">
    <h1>Thêm User mới</h1>

    <form action="{{ route('users.store') }}" method="POST" class="crud-form">
        @csrf

        <div class="form-group">
            <label>Tên đăng nhập (Username):</label>
            <input type="text" name="username" placeholder="Nhập username" required class="input-full">
        </div>

        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" placeholder="Nhập email" required class="input-full">
        </div>

        <div class="form-group">
            <label>Họ và tên:</label>
            <input type="text" name="fullname" placeholder="Nhập họ tên đầy đủ" required class="input-full">
        </div>

        <div class="form-group">
            <label>Mật khẩu:</label>
            <input type="password" name="password" placeholder="Nhập mật khẩu" required class="input-full">
        </div>

        <div class="form-group">
            <label>Quyền hạn (Role):</label>
            <select name="role" class="input-full">
                <option value="admin">Admin</option>
                <option value="user" selected>User</option>
            </select>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-save-user">Lưu User</button>
            <a href="{{ route('users.index') }}" class="btn-cancel">Hủy</a>
        </div>
    </form>
</div>
@endsection

@extends('layouts.master')

@section('title', 'Sửa User')

@section('content')
<div class="container form-container">
    <h1>Sửa User: {{ $user->username }}</h1>

    <form action="{{ route('users.update', $user->id) }}" method="POST" class="crud-form">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Tên đăng nhập:</label>
            <input type="text" name="username" value="{{ $user->username }}" class="input-full" required>
        </div>

        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" value="{{ $user->email }}" class="input-full" required>
        </div>

        <div class="form-group">
            <label>Họ và tên:</label>
            <input type="text" name="fullname" value="{{ $user->fullname }}" class="input-full" required>
        </div>

        <div class="form-group">
            <label>Mật khẩu:</label>
            <input type="password" name="password" placeholder="Bỏ trống nếu không đổi mật khẩu" class="input-full">
            <small class="form-note">* Chỉ nhập nếu bạn muốn thay đổi mật khẩu mới.</small>
        </div>

        <div class="form-group">
            <label>Role:</label>
            <select name="role" class="input-full">
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
            </select>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-update-user">Cập nhật</button>
            <a href="{{ route('users.index') }}" class="btn-cancel">Hủy</a>
        </div>
    </form>
</div>
@endsection

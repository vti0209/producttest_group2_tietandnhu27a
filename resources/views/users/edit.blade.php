@extends('layouts.master')
@section('content')
<div class="container">
    <h1>Sửa User: {{ $user->username }}</h1>
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf @method('PUT')
        <input type="text" name="username" value="{{ $user->username }}" class="form-control"><br>
        <input type="email" name="email" value="{{ $user->email }}" class="form-control"><br>
        <input type="text" name="fullname" value="{{ $user->fullname }}" class="form-control"><br>
        <input type="password" name="password" placeholder="Bỏ trống nếu không đổi mật khẩu" class="form-control"><br>
        <select name="role" class="form-control">
            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
        </select><br>
        <button type="submit" style="background: blue; color: white;">Cập nhật</button>
    </form>
</div>
@endsection

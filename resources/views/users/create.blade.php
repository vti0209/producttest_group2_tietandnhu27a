@extends('layouts.master')
@section('content')
<div class="container">
    <h1>Thêm User mới</h1>
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <input type="text" name="username" placeholder="Username" required class="form-control"><br>
        <input type="email" name="email" placeholder="Email" required class="form-control"><br>
        <input type="text" name="fullname" placeholder="Họ tên" required class="form-control"><br>
        <input type="password" name="password" placeholder="Mật khẩu" required class="form-control"><br>
        <select name="role" class="form-control">
            <option value="admin">Admin</option>
            <option value="user">User</option>
        </select><br>
        <button type="submit" style="background: green; color: white;">Lưu User</button>
    </form>
</div>
@endsection

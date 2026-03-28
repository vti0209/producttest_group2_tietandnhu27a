@extends('layouts.master')

@section('title', 'Danh sách người dùng')

@section('content')
<div class="container">
    <div class="header-actions" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h1>👥 Quản lý User</h1>
        <a href="{{ route('users.create') }}" class="btn-add" style="background: #27ae60; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none;">+ Thêm User</a>
    </div>

    <table border="1" width="100%" style="border-collapse: collapse; text-align: left;">
        <thead>
            <tr style="background-color: #f2f2f2;">
                <th style="padding: 10px;">ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Fullname</th>
                <th>Role</th>
                <th>Ngày tạo</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td style="padding: 10px;">{{ $user->id }}</td>
                <td><strong>{{ $user->username }}</strong></td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->fullname }}</td>
                <td>
                    <span class="badge {{ $user->role }}" style="padding: 3px 8px; border-radius: 4px; background: #eee;">
                        {{ $user->role }}
                    </span>
                </td>
                <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                <td>
                    <a href="{{ route('users.edit', $user->id) }}" style="color: blue;">Sửa</a> |
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" style="color: red; background: none; border: none; cursor: pointer; text-decoration: underline;" onclick="return confirm('Xác nhận xóa người dùng này?')">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

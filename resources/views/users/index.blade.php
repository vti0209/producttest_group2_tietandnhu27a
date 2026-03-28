@extends('layouts.master')

@section('title', 'Danh sách người dùng')

@section('content')
<div class="container">
    <div class="header-actions">
        <h1>Quản lý User</h1>
        <a href="{{ route('users.create') }}" class="btn-add-user">+ Thêm User</a>
    </div>

    <table class="table-list">
        <thead>
            <tr>
                <th>ID</th>
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
                <td>{{ $user->id }}</td>
                <td><strong>{{ $user->username }}</strong></td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->fullname }}</td>
                <td>
                    <span class="badge badge-{{ $user->role }}">
                        {{ $user->role }}
                    </span>
                </td>
                <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                <td class="action-buttons">
                    <a href="{{ route('users.edit', $user->id) }}" class="btn-edit">Sửa</a> |
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline-form">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-delete-link"
                                onclick="return confirm('Xác nhận xóa người dùng này?')">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@extends('layouts.master')

@section('title', 'Danh sách người dùng')

@section('content')
<div class="container">
    <div class="header-actions">
        <h1>Users</h1>
        <a href="{{ route('products.index') }}" class="btn-link-gray">Products</a>
    </div>
    <form action="{{ route('users.index') }}" method="GET" class="filter-form mb-3">
        <input type="text" name="search" class="input-control" placeholder="Tìm tên, user, email..." value="{{ request('search') }}">

        <label>Từ ngày:</label>
        <input type="date" name="start_date" class="input-control" value="{{ request('start_date') }}">

        <label>Đến ngày:</label>
        <input type="date" name="end_date" class="input-control" value="{{ request('end_date') }}">

        <button type="submit" class="btn-submit-primary">Lọc</button>
        <a href="{{ route('users.index') }}" class="btn-reset">Xóa lọc</a>
    </form>
    <div class="add-user-wrapper">
        <a href="{{ route('users.create') }}" class="btn-add-text">+ Thêm user</a>
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
    <div class="d-flex justify-content-center mt-4">
        {{ $users->links() }}
    </div>
</div>
@endsection

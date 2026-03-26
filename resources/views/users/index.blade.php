<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý người dùng</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .header { display: flex; justify-content: space-between; align-items: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #999; padding: 8px; text-align: left; }
        .action-link { color: blue; text-decoration: underline; cursor: pointer; border: none; background: none; }
        .modal { display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); }
        .modal-content { background: #fff; margin: 5% auto; padding: 20px; width: 400px; border-radius: 5px; }
        .form-group { margin-bottom: 10px; }
        .form-group input, .form-group select { width: 100%; padding: 8px; box-sizing: border-box; }
    </style>
</head>
<body>

<div class="header">
    <h1>Người dùng</h1>
    <div>Xin chào, <strong>Tiet</strong> | <a href="#">Logout</a></div>
</div>

<div style="margin-bottom: 10px;"><a href="{{ route('products.index') }}">Quay lại Sản phẩm</a></div>

<button onclick="document.getElementById('addModal').style.display='block'" style="color: purple; font-weight: bold; border:none; background:none; cursor:pointer;">+ Thêm người dùng</button>

<table>
    <thead>
        <tr>
            <th>Username</th>
            <th>Họ tên</th>
            <th>Email</th>
            <th>Vai trò</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->username }}</td>
            <td>{{ $user->fullname }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->role }}</td>
            <td>
                <button class="action-link" onclick='openEditModal({!! json_encode($user) !!})'>Sửa</button> |
                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button type="submit" class="action-link" style="color:red" onclick="return confirm('Xóa User này?')">Xóa</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div id="addModal" class="modal">
    <div class="modal-content">
        <h3>Thêm người dùng</h3>
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="form-group"><input type="text" name="username" placeholder="Username" required></div>
            <div class="form-group"><input type="password" name="password" placeholder="Mật khẩu" required></div>
            <div class="form-group"><input type="text" name="fullname" placeholder="Họ tên"></div>
            <div class="form-group"><input type="email" name="email" placeholder="Email"></div>
            <div class="form-group">
                <select name="role">
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <button type="submit" style="background:purple; color:white; padding:10px;">Lưu</button>
            <button type="button" onclick="this.closest('.modal').style.display='none'">Hủy</button>
        </form>
    </div>
</div>

<div id="editModal" class="modal">
    <div class="modal-content">
        <h3>Sửa người dùng</h3>
        <form id="editForm" method="POST">
            @csrf @method('PUT')
            <div class="form-group"><input type="text" name="username" id="edit_username" required></div>
            <div class="form-group"><input type="password" name="password" placeholder="Mật khẩu mới (bỏ trống nếu không đổi)"></div>
            <div class="form-group"><input type="text" name="fullname" id="edit_fullname"></div>
            <div class="form-group"><input type="email" name="email" id="edit_email"></div>
            <div class="form-group">
                <select name="role" id="edit_role">
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <button type="submit" style="background:blue; color:white; padding:10px;">Cập nhật</button>
            <button type="button" onclick="this.closest('.modal').style.display='none'">Hủy</button>
        </form>
    </div>
</div>

<script>
    function openEditModal(user) {
        document.getElementById('editModal').style.display = 'block';
        document.getElementById('edit_username').value = user.username;
        document.getElementById('edit_fullname').value = user.fullname;
        document.getElementById('edit_email').value = user.email;
        document.getElementById('edit_role').value = user.role;
        document.getElementById('editForm').action = '/users/' + user.id;
    }
</script>

</body>
</html>

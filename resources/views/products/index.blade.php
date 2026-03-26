<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý sản phẩm</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .header { display: flex; justify-content: space-between; align-items: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #999; padding: 8px; text-align: left; }
        .filter-bar { margin: 15px 0; display: flex; gap: 5px; }
        .add-btn { color: purple; font-weight: bold; text-decoration: none; cursor: pointer; }
        .action-link { color: blue; text-decoration: underline; cursor: pointer; border: none; background: none; padding: 0; margin: 0 5px; }

        /* Modal Style */
        .modal { display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); }
        .modal-content { background: #fff; margin: 10% auto; padding: 20px; border-radius: 5px; width: 400px; box-shadow: 0 4px 8px rgba(0,0,0,0.2); }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; }
        .form-group input, .form-group select { width: 100%; padding: 8px; box-sizing: border-box; }
        .btn-submit { background: purple; color: white; border: none; padding: 10px 15px; cursor: pointer; }
        .btn-cancel { background: #ccc; border: none; padding: 10px 15px; cursor: pointer; margin-left: 10px; }
    </style>
</head>
<body>

<div class="header">
    <h1>Sản phẩm</h1>
    <div>Xin chào, <strong>Tiet</strong> | <a href="#">Logout</a></div>
</div>

<div style="margin-bottom: 10px;">
    <a href="{{ route('users.index') }}">Users</a>
</div>

<form action="{{ route('products.index') }}" method="GET" class="filter-bar">
    <input type="text" name="search" placeholder="Tìm tên..." value="{{ request('search') }}">

    <select name="category_id">
        <option value="">-- Tất cả loại --</option>
        @foreach($categories as $cat)
            <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
        @endforeach
    </select>

    <select name="sort">
        <option value="">-- Sắp xếp --</option>
        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Giá tăng dần</option>
        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Giá giảm dần</option>
    </select>

    <input type="number" name="max_price" placeholder="Giá tối đa" value="{{ request('max_price') }}">
    <button type="submit">Áp dụng</button>
</form>

<a href="javascript:void(0)" class="add-btn" onclick="openAddModal()">+ Thêm sản phẩm</a>

<table>
    <thead>
        <tr>
            <th>Tên</th>
            <th>Giá</th>
            <th>Loại</th>
            <th>Tồn</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
        <tr>
            <td style="color: blue; text-decoration: underline;">{{ $product->name }}</td>
            <td>{{ number_format($product->price, 0, '', '') }}</td>
            <td>{{ $product->category->name ?? 'N/A' }}</td>
            <td>{{ $product->stock }}</td>
            <td>
                <button class="action-link" onclick='openEditModal({!! json_encode($product) !!})'>Sửa</button> |

                <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="action-link" style="color:red" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div id="addModal" class="modal">
    <div class="modal-content">
        <h3>Thêm sản phẩm mới</h3>
        <form action="{{ route('products.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Tên sản phẩm:</label>
                <input type="text" name="name" required>
            </div>
            <div class="form-group">
                <label>Giá:</label>
                <input type="number" name="price" required>
            </div>
            <div class="form-group">
                <label>Loại sản phẩm:</label>
                <select name="category_id" required>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Số lượng tồn:</label>
                <input type="number" name="stock" required>
            </div>
            <button type="submit" class="btn-submit">Lưu lại</button>
            <button type="button" class="btn-cancel" onclick="closeModal('addModal')">Hủy</button>
        </form>
    </div>
</div>

<div id="editModal" class="modal">
    <div class="modal-content">
        <h3>Cập nhật sản phẩm</h3>
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Tên sản phẩm:</label>
                <input type="text" name="name" id="edit_name" required>
            </div>
            <div class="form-group">
                <label>Giá:</label>
                <input type="number" name="price" id="edit_price" required>
            </div>
            <div class="form-group">
                <label>Loại sản phẩm:</label>
                <select name="category_id" id="edit_category_id" required>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Số lượng tồn:</label>
                <input type="number" name="stock" id="edit_stock" required>
            </div>
            <button type="submit" class="btn-submit" style="background:blue;">Cập nhật</button>
            <button type="button" class="btn-cancel" onclick="closeModal('editModal')">Hủy</button>
        </form>
    </div>
</div>

<script>
    function openAddModal() {
        document.getElementById('addModal').style.display = 'block';
    }

    function openEditModal(product) {
        document.getElementById('editModal').style.display = 'block';
        document.getElementById('edit_name').value = product.name;
        document.getElementById('edit_price').value = product.price;
        document.getElementById('edit_category_id').value = product.category_id;
        document.getElementById('edit_stock').value = product.stock;
        // Cập nhật URL action cho Form Sửa
        document.getElementById('editForm').action = '/products/' + product.id;
    }

    function closeModal(id) {
        document.getElementById(id).style.display = 'none';
    }

    // Đóng modal khi click ra ngoài
    window.onclick = function(event) {
        if (event.target.className === 'modal') {
            event.target.style.display = "none";
        }
    }
</script>

</body>
</html>

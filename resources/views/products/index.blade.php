@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Sản phẩm</h1>
    <a href="{{ route('users.index') }}">Users</a>

    <form action="{{ route('products.index') }}" method="GET" class="filter-form">
        {{-- Tìm theo tên --}}
        <input type="text" name="search" placeholder="Tìm tên..." value="{{ request('search') }}">

        {{-- Lọc theo loại --}}
        <select name="category_id">
            <option value="">-- Tất cả loại --</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        {{-- Sắp xếp --}}
        <select name="sort">
            <option value="">-- Sắp xếp --</option>
            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Giá tăng dần</option>
            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Giá giảm dần</option>
        </select>

        {{-- Lọc giá tối đa --}}
        <input type="number" name="max_price" placeholder="Giá tối đa" value="{{ request('max_price') }}">

        <button type="submit">Áp dụng</button>

        {{-- Nút xóa nhanh các bộ lọc --}}
        <a href="{{ route('products.index') }}" style="margin-left: 10px; text-decoration: none; color: gray; font-size: 13px;">Xóa lọc</a>
    </form>

    <div class="add-product">
        <a href="{{ route('products.create') }}" class="text-purple">+ Thêm sản phẩm</a>
    </div>

    <table border="1" width="100%" style="border-collapse: collapse; margin-top: 20px;">
        <thead>
            <tr style="background-color: #f2f2f2;">
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
                <td><a href="#">{{ $product->name }}</a></td>
                <td>{{ number_format($product->price, 0, ',', '.') }}</td>
                <td>{{ $product->category->name ?? 'N/A' }}</td>
                <td>{{ $product->stock }}</td>
                <td>
                    <a href="{{ route('products.edit', $product->id) }}" style="color: blue;">Sửa</a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                style="color: red; background: none; border: none; padding: 0; cursor: pointer; text-decoration: underline;"
                                onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">
                            Xóa
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

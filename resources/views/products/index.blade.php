@extends('layouts.master')

@section('title', 'Sản phẩm')

@section('content')
<div class="container">
    <div class="page-header">
        <h1>Sản phẩm</h1>
        <a href="{{ route('users.index') }}" class="btn-link-gray">Users</a>
    </div>

    <form action="{{ route('products.index') }}" method="GET" class="filter-form">
        {{-- Tìm theo tên --}}
        <input type="text" name="search" class="input-control" placeholder="Tìm tên..." value="{{ request('search') }}">

        {{-- Lọc theo loại --}}
        <select name="category_id" class="select-control">
            <option value="">-- Tất cả loại --</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        {{-- Sắp xếp --}}
        <select name="sort" class="select-control">
            <option value="">-- Sắp xếp --</option>
            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Giá tăng dần</option>
            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Giá giảm dần</option>
        </select>

        {{-- Lọc giá tối đa --}}
        <input type="number" name="max_price" class="input-control" placeholder="Giá tối đa" value="{{ request('max_price') }}">

        <button type="submit" class="btn-submit-primary">Áp dụng</button>

        {{-- Nút xóa nhanh các bộ lọc --}}
        <a href="{{ route('products.index') }}" class="btn-reset">Xóa lọc</a>
    </form>

    <div class="add-product-wrapper">
        <a href="{{ route('products.create') }}" class="btn-add-text">+ Thêm sản phẩm</a>
    </div>

    <table class="table-list">
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
                <td>
                    <a href="{{ route('products.show', $product->id) }}" class="product-name-link">
                        {{ $product->name }}
                    </a>
                </td>
                <td>{{ number_format($product->price, 0, ',', '.') }}đ</td>
                <td>{{ $product->category->name ?? 'N/A' }}</td>
                <td>{{ $product->stock }}</td>
                <td class="action-buttons">
                    <a href="{{ route('products.edit', $product->id) }}" class="btn-edit">Sửa</a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete-link"
                                onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">
                            Xóa
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center mt-4">
        {{ $products->links() }} 
    </div>
</div>
@endsection

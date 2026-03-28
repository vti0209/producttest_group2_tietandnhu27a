@extends('layouts.master')

@section('title', 'Thêm sản phẩm mới')

@section('content')
<div class="container">
    <h1>Thêm sản phẩm mới</h1>
    <a href="{{ route('products.index') }}">← Quay lại danh sách</a>

    <form action="{{ route('products.store') }}" method="POST" style="margin-top: 20px;">
        @csrf {{-- Bắt buộc phải có để bảo mật --}}

        <div style="margin-bottom: 15px;">
            <label>Tên sản phẩm:</label><br>
            <input type="text" name="name" required style="width: 100%; padding: 8px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label>Giá:</label><br>
            <input type="number" name="price" required style="width: 100%; padding: 8px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label>Loại sản phẩm:</label><br>
            <select name="category_id" required style="width: 100%; padding: 8px;">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div style="margin-bottom: 15px;">
            <label>Số lượng tồn:</label><br>
            <input type="number" name="stock" required style="width: 100%; padding: 8px;">
        </div>

        <button type="submit" style="background: purple; color: white; padding: 10px 20px; border: none; cursor: pointer;">
            Lưu sản phẩm
        </button>
    </form>
</div>
@endsection

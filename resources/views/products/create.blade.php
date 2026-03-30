@extends('layouts.master')

@section('title', 'Thêm sản phẩm mới')

@section('content')
<div class="container form-container">
    <h1>Thêm sản phẩm mới</h1>
    <a href="{{ route('products.index') }}" class="btn-back-link">Quay lại</a>

    <form action="{{ route('products.store') }}" method="POST" class="crud-form main-form-margin">
        @csrf {{-- Bắt buộc phải có để bảo mật --}}

        <div class="form-group">
            <label>Tên sản phẩm:</label>
            <input type="text" name="name" required class="input-full">
        </div>

        <div class="form-group">
            <label>Giá:</label>
            <input type="number" name="price" required class="input-full">
        </div>

        <div class="form-group">
            <label>Loại sản phẩm:</label>
            <select name="category_id" required class="input-full">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Số lượng tồn:</label>
            <input type="number" name="stock" required class="input-full">
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-save">
                Lưu sản phẩm
            </button>
        </div>
    </form>
</div>
@endsection

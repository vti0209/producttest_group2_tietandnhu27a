@extends('layouts.master')

@section('title', 'Sửa sản phẩm')

@section('content')
<div class="container form-container">
    <h1>Sửa sản phẩm: {{ $product->name }}</h1>

    <form action="{{ route('products.update', $product->id) }}" method="POST" class="crud-form">
        @csrf
        @method('PUT') {{-- Bắt buộc để gửi phương thức UPDATE --}}

        <div class="form-group">
            <label>Tên sản phẩm</label>
            <input type="text" name="name" value="{{ $product->name }}" required class="input-full">
        </div>

        <div class="form-group">
            <label>Giá</label>
            <input type="number" name="price" value="{{ $product->price }}" required class="input-full">
        </div>

        <div class="form-group">
            <label>Loại</label>
            <select name="category_id" class="input-full">
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Tồn kho</label>
            <input type="number" name="stock" value="{{ $product->stock }}" required class="input-full">
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-update">Cập nhật</button>
            <a href="{{ route('products.index') }}" class="btn-cancel">Hủy</a>
        </div>
    </form>
</div>
@endsection

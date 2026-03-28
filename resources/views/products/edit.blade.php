@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Sửa sản phẩm: {{ $product->name }}</h1>

    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT') {{-- Bắt buộc để gửi phương thức UPDATE --}}

        <div style="margin-bottom:10px;">
            <label>Tên sản phẩm</label><br>
            <input type="text" name="name" value="{{ $product->name }}" required style="width:100%;">
        </div>

        <div style="margin-bottom:10px;">
            <label>Giá</label><br>
            <input type="number" name="price" value="{{ $product->price }}" required style="width:100%;">
        </div>

        <div style="margin-bottom:10px;">
            <label>Loại</label><br>
            <select name="category_id" style="width:100%;">
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div style="margin-bottom:10px;">
            <label>Tồn kho</label><br>
            <input type="number" name="stock" value="{{ $product->stock }}" required style="width:100%;">
        </div>

        <button type="submit" style="background:blue; color:white; padding:10px;">Cập nhật</button>
        <a href="{{ route('products.index') }}">Hủy</a>
    </form>
</div>
@endsection

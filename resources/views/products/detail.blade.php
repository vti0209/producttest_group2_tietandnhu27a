@extends('layouts.master')

@section('title', 'Chi tiết sản phẩm')

@section('content')
<div class="container detail-container">
    <div class="detail-card">
        <h1 class="detail-header">
            📦 {{ $product->name }}
        </h1>

        <div class="detail-body">
            <p><strong>Mã sản phẩm:</strong> #{{ $product->id }}</p>
            <p><strong>Loại sản phẩm:</strong>
                <span class="category-badge">
                    {{ $product->category->name ?? 'N/A' }}
                </span>
            </p>
            <p><strong>Giá bán:</strong>
                <span class="price-highlight">
                    {{ number_format($product->price, 0, ',', '.') }} VNĐ
                </span>
            </p>
            <p><strong>Số lượng tồn kho:</strong> {{ $product->stock }} sản phẩm</p>
            <p><strong>Ngày tạo:</strong> {{ $product->created_at->format('d/m/Y H:i') }}</p>
        </div>

        <hr class="detail-divider">

        <div class="detail-footer">
            <a href="{{ route('products.index') }}" class="btn-back">
                ← Quay lại danh sách
            </a>
            <span class="v-divider">|</span>
            <a href="{{ route('products.edit', $product->id) }}" class="btn-edit-text">
                Chỉnh sửa thông tin
            </a>
        </div>
    </div>
</div>
@endsection

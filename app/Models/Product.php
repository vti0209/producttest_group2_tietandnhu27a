<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // 1. Chỉ định đúng tên bảng trong SQL của bạn
    protected $table = 'products';

    // 2. Các cột có thể nhập dữ liệu (khớp với file SQL)
    protected $fillable = ['name', 'price', 'category_id', 'stock'];

    // 3. Thiết lập mối quan hệ với bảng Category
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}

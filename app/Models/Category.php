<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // 1. Khai báo tên bảng (vì mặc định Laravel tìm 'categories', trùng với tên của bạn nên dòng này có thể bỏ qua, nhưng viết vào cho chắc chắn)
    protected $table = 'categories';

    // 2. Khai báo các cột có thể nhập dữ liệu (Mass Assignment)
    // Giúp bạn có thể dùng lệnh Category::create([...])
    protected $fillable = ['name', 'description'];

    /**
     * Thiết lập mối quan hệ: Một danh mục có nhiều sản phẩm
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
}

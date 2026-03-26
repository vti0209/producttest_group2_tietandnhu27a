<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // 1. Hiển thị danh sách + Tìm kiếm + Lọc
    public function index(Request $request)
    {
        $categories = Category::all();
        $query = Product::with('category');

        // Tìm theo tên
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Lọc theo loại
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Lọc theo giá tối đa
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Sắp xếp
        if ($request->sort == 'price_asc') $query->orderBy('price', 'asc');
        elseif ($request->sort == 'price_desc') $query->orderBy('price', 'desc');

        $products = $query->get();

        return view('products.index', compact('products', 'categories'));
    }



    // 3. Cập nhật sản phẩm
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->all());
        return redirect()->back()->with('success', 'Cập nhật thành công!');
    }

    // 4. Xóa sản phẩm
    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Đã xóa sản phẩm!');
    }

    public function store(Request $request)
{
    // Validate dữ liệu (Kiểm tra đầu vào)
    $request->validate([
        'name' => 'required',
        'price' => 'required|numeric',
        'stock' => 'required|integer',
    ]);

    // Gọi Model để lưu vào DB
    \App\Models\Product::create($request->all());

    return redirect()->back()->with('success', 'Thêm mới thành công!');
}
}

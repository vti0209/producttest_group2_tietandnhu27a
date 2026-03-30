<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
public function index(Request $request)
    {
        // 1. Khởi tạo query từ model Product
        $query = Product::query();

        // 2. Tìm kiếm theo tên (nếu có nhập)
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // 3. Lọc theo loại sản phẩm (nếu có chọn)
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // 4. Lọc theo giá tối đa (nếu có nhập)
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // 5. Sắp xếp theo giá (nếu có chọn)
        if ($request->filled('sort')) {
            if ($request->sort == 'price_asc') {
                $query->orderBy('price', 'asc');
            } elseif ($request->sort == 'price_desc') {
                $query->orderBy('price', 'desc');
            }
        } else {
            // Mặc định sắp xếp theo ID mới nhất
            $query->orderBy('id', 'desc');
        }

        // 6. Thực hiện lấy dữ liệu
        $products = $query->with('category')->paginate(5);
        $categories = Category::all();

        // 7. Trả về view
        return view('products.index', compact('products', 'categories'));
    }
    public function create()
        {
            $categories = Category::all();
            return view('products.create', compact('categories'));
        }

        public function store(Request $request)
        {
            // Lưu dữ liệu vào bảng products
            Product::create([
                'name' => $request->name,
                'price' => $request->price,
                'category_id' => $request->category_id,
                'stock' => $request->stock,
            ]);

            return redirect()->route('products.index')->with('success', 'Đã thêm sản phẩm thành công!');
        }

        public function destroy($id)
    {
        // Tìm sản phẩm theo ID, nếu không thấy sẽ báo lỗi 404
        $product = Product::findOrFail($id);

        // Thực hiện xóa
        $product->delete();

        // Quay lại trang danh sách với thông báo thành công
        return redirect()->route('products.index')->with('success', 'Đã xóa sản phẩm thành công!');
    }
    public function edit($id)
        {
            $product = Product::findOrFail($id); // Tìm sản phẩm hoặc báo lỗi 404
            $categories = Category::all(); // Lấy danh sách loại để chọn lại nếu muốn
            return view('products.edit', compact('product', 'categories'));
        }

        public function update(Request $request, $id)
        {
            $product = Product::findOrFail($id);

            // Cập nhật dữ liệu mới từ form
            $product->update([
                'name' => $request->name,
                'price' => $request->price,
                'category_id' => $request->category_id,
                'stock' => $request->stock,
            ]);

            return redirect()->route('products.index')->with('success', 'Cập nhật sản phẩm thành công!');
        }
        public function show($id)
            {
                // Lấy sản phẩm kèm theo thông tin Category (Eager Loading)
                $product = Product::with('category')->findOrFail($id);

                return view('products.detail', compact('product'));
            }
}

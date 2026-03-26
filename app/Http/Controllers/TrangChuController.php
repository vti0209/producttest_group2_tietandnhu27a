<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;


class TrangChuController extends Controller
{
   public function index(Request $request)
{
    $query = Product::with('category');

    if ($request->keyword) {
        $query->where('name', 'like', '%'.$request->keyword.'%');
    }

    if ($request->category) {
        $query->where('category_id', $request->category);
    }

    $products = $query->paginate(5);
    $categories = Category::all();

    return view('trangchu', compact('products', 'categories'));
}
}
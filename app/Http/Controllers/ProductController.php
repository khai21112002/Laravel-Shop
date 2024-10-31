<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function displayProductList(Request $request)
{
    $categoryIdProduct = $request->get('categoryIdProduct');
    $searchTermProduct = $request->get('searchProduct');

    // Kiểm tra xem là request từ AJAX hay không
    if ($request->ajax()) {
        // Lọc sản phẩm theo categoryId và từ khóa tìm kiếm
        $products = Product::with('productImages')
            ->when($categoryIdProduct, function ($query) use ($categoryIdProduct) {
                return $query->where('category_id', $categoryIdProduct);
            })
            ->when($searchTermProduct, function ($query) use ($searchTermProduct) {
                return $query->where('name', 'like', "%{$searchTermProduct}%");
            })
            ->paginate(6);

        // Trả về view hiển thị sản phẩm
        return view('partials.product_list', compact('products'))->render();
    } else {
        // Nếu không phải AJAX, lấy tất cả sản phẩm và danh mục
        $categories = Category::all();
        $products = Product::with('productImages')->paginate(6);
        return view('site.product', compact('products', 'categories'));
    }
}
}

<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function displayProductHome(Request $request)
    {
        $categoryIdHome = $request->get('categoryIdHome');
        $searchTermHome = $request->get('searchHome');

        // Kiểm tra xem là request từ AJAX hay không
        if ($request->ajax()) {
            // Lọc sản phẩm theo categoryId và từ khóa tìm kiếm
            $products = Product::with('productImages')
                ->when($categoryIdHome, function ($query) use ($categoryIdHome) {
                    return $query->where('category_id', $categoryIdHome);
                })
                ->when($searchTermHome, function ($query) use ($searchTermHome) {
                    return $query->where('name', 'like', "%{$searchTermHome}%");
                })
                ->take(9)->get();
            // Trả về view hiển thị sản phẩm
            return view('partials.product_list', compact('products'))->render();
        } else {
            // Nếu không phải AJAX, lấy tất cả sản phẩm và danh mục
            $categories = Category::all();
            $products = Product::with('productImages')->take(9)->get();
            return view('site.index', compact('products', 'categories'));
        }
    }
}

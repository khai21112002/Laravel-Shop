<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function product_details($product_slug)
    {
        $product = Product::where('slug', $product_slug)->firstOrFail();
        $productImage = ProductImage::where('product_id', $product->id)->get();
        
        return view('details', compact('product', 'productImage'));
    }
}

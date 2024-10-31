<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Surfsidemedia\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Cart::instance('cart')->content();
        $total = 0;
        foreach ($products as $product) {
            $subtotal = $product->price * $product->qty;
            $total += $subtotal;
        }

        return view('cart', compact('products', 'total'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function add_to_cart(Request $request)
    {
        Cart::instance('cart')->add([
            'id' => $request->input('product.id'),
            'name' => $request->input('product.name'),
            'qty' => $request->input('quantity'),
            'price' => $request->input('product.price'),
            'options' => [
                'category' => $request->input('product.category'),
                'image' => $request->input('product.image'),
            ],
        ]);

        return redirect()->route('cart.index')->with('success', 'Product added to cart successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Cart::instance('cart')->update($id, $request->input('quantity'));

        return redirect()->route('cart.index')->with('success', 'Product quantity updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Cart::instance('cart')->remove($id);

        return redirect()->route('cart.index')->with('success', 'Product removed from cart successfully.');
    }

    public function clear()
    {
        Cart::instance('cart')->destroy();
        return redirect()->route('cart.index')->with('success', 'Cart has been cleared!');
    }

    public function checkout()
    {
        $products = Cart::instance('cart')->content();
        $total = 0;
        foreach ($products as $product) {
            $subtotal = $product->price * $product->qty;
            $total += $subtotal;
        }
        return view('checkout', compact('products', 'total'));
    }
}

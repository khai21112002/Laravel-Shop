<?php

namespace App\Livewire;

use Livewire\Component;
use Surfsidemedia\Shoppingcart\Facades\Cart;

class Cartliveware extends Component
{
    public $products = [];
    
    public function mount()
    {
        $this->loadProducts();
    }

    public function loadProducts()
    {
        $this->products = Cart::content()->map(function ($product) {
            return [
                'rowId' => $product->rowId,
                'id' => $product->id,
                'qty' => $product->qty,
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->options->image,
                'category' => $product->options->category,
            ];
        })->toArray(); // Chuyển đổi thành mảng đơn giản
    }

    public function updateQuantity($rowId, $quantity)
    {
        Cart::update($rowId, $quantity);
        $this->loadProducts(); // Tải lại sản phẩm sau khi cập nhật
    }

    public function removeItem($rowId)
    {
        Cart::remove($rowId);
        $this->loadProducts(); // Tải lại sản phẩm sau khi xóa
    }

    public function render()
    {
        return view('livewire.cartliveware');
    }
}
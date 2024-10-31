<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SearchEngineController extends Controller
{
    public function search($type, Request $request) {
        $query = $request->input('query');
        Log::info('search query:', ['query' => $query, 'type' => $type]);

        switch ($type) {
            case 'products':
                return $this->searchProduct($query); 
            case 'users':
                return $this->searchUser($query); 
            case 'orders':
                return $this->searchOrder($query); 
            default:
                return redirect()->back()->withErrors('Invalid search type.');
        }
    }

    protected function searchProduct($query) {
        $productsQuery = Product::with('category')
            ->when($query, function ($queryBuilder) use ($query) {
                $queryBuilder->where('name', 'LIKE', '%' . $query . '%')
                    ->orWhereHas('category', function ($subQuery) use ($query) {
                        $subQuery->where('name', 'LIKE', '%' . $query . '%');
                    });
            });

        $categories = Category::all();
        $products = $productsQuery->paginate(3)->appends(['query' => $query]);
        Log::info('Search results:', ['products' => $products->items()]);

        return view('products', compact('products', 'query', 'categories'));
    }

    protected function searchUser($query) {
        $role = null;

        if (strtolower($query) === 'admin') {
            $role = 1; 
        } elseif (strtolower($query) === 'user') {
            $role = 0; 
        }

        $users = User::when($query, function ($queryBuilder) use ($query, $role) {
            $queryBuilder->where('name', 'LIKE', "%{$query}%")
                ->orWhere('email', 'LIKE', "%{$query}%")
                ->orWhere('phone', 'LIKE', "%{$query}%");
                if ($role !== null) {
                    $queryBuilder->orWhere('role', $role);
                }
        })->paginate(10)->appends(['query' => $query]);

        Log::info('Results users querying:', ['users' => $users->items()]);
        return view('users', compact('users'));
    }

    protected function searchOrder($query) {
        $orders = Order::when($query, function ($queryBuilder) use ($query) {
            $queryBuilder->where('order_code', 'LIKE', "%{$query}%");
        })->paginate(5);

        Log::info('Search results for orders:', ['orders' => $orders->items()]);
        return view('orders', compact('orders'));
    }
}

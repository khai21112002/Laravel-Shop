<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserOrderController extends Controller
{
    public function getOrdersByUser(Request $request) {
        $searchTermOrder = $request->get('searchOrder');
        $id = Auth::user()->id;

        if ($request->ajax()) {
            $orders = Order::where('user_id', $id)
                ->when($searchTermOrder, function ($query) use ($searchTermOrder) {
                    return $query->where('order_code', 'like', "%{$searchTermOrder}%");
                })
                ->paginate(2);

            // Chỉ trả về phần thân của bảng
            return view('partials.order_list', compact('orders'))->render();
        } else {
            $orders = Order::where('user_id', $id)->paginate(2);
            return view('site.order', compact('orders'));
        }
    }
}

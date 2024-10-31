<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Surfsidemedia\Shoppingcart\Facades\Cart;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $order = Order::create([
            'user_id' => Auth::id(),
            'fullname' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'received_address' => $request->address,
            'payment_method' => 0,
            'status' => 0,
            'total_amount' => (int) str_replace([','], '', Cart::instance('cart')->subtotal()),
            'order_code' => 'ORD-' . time() . '-' . Str::random(5),
        ]);

        $cartItems = Cart::content();
        foreach ($cartItems as $item) {
            OrderDetail::create([
                'order_id' => $order->id,
                'product_name' => $item->name,
                'product_img' => $item->options->image,
                'quantity' => $item->qty,
                'price' => $item->price,
            ]);
        }

        Cart::destroy();
        return redirect()->route('order.confirmation')->with('success', 'Order placed successfully!');
    }

    public function order_confirmation()
    {
        $order = Order::where('user_id', Auth::id())->latest()->first();
        $orderDetails = OrderDetail::where('order_id', $order->id)->get();

        switch ($order->payment_method) {
            case 0:
                $order->payment_method_text = 'Cash on Delivery';
                break;
            default:
                $order->payment_method_text = 'Other Payment Method';
                break;
        }

        switch ($order->status) {
            case 0:
                $order->status_text = 'Placed successfully';
                break;
            case 1:
                $order->status_text = 'Are shipping';
                break;
            case 2:
                $order->status_text = 'Receive success';
                break;
            case 3:
                $order->status_text = 'Cancel order';
                break;
            default:
                $order->status_text = 'Unknown status';
                break;
        }

        return view('order-confirmation', [
            'order' => $order,
            'orderDetails' => $orderDetails
        ]);
    }

    public function order_detail($orderId)
    {
        $order = Order::where('id', $orderId)->where('user_id', Auth::id())->first();


        if (!$order) {
            return redirect()->route('site.index')->with('error', 'Order not found or access denied.');
        }
        $orderDetails = OrderDetail::where('order_id', $order->id)->get();

        switch ($order->payment_method) {
            case 0:
                $order->payment_method_text = 'Cash on Delivery';
                break;
            default:
                $order->payment_method_text = 'Other Payment Method';
                break;
        }
        switch ($order->status) {
            case 0:
                $order->status_text = 'Placed successfully';
                break;
            case 1:
                $order->status_text = 'Are shipping';
                break;
            case 2:
                $order->status_text = 'Received successfully';
                break;
            case 3:
                $order->status_text = 'Cancel order';
                break;
            default:
                $order->status_text = 'Unknown status';
                break;
        }

        return view('order-detail', [
            'order' => $order,
            'orderDetails' => $orderDetails
        ]);
    }
    public function cancelOrder(Request $request)
    {
        $order = Order::where('id', $request->order_id)->where('user_id', Auth::id())->first();

        if (!$order) {
            return redirect()->back()->with('error', 'Order not found or access denied.');
        }

        $order->status = 3;
        $order->save();

        return redirect()->route('order.detail', $order->id)->with('success', 'Order has been received.');
    }
    public function receiveOrder(Request $request)
    {
        $order = Order::where('id', $request->order_id)->where('user_id', Auth::id())->first();

        if (!$order) {
            return redirect()->back()->with('error', 'Order not found or access denied.');
        }
        
        $order->status = 2;
        $order->save();

        return redirect()->route('order.detail', $order->id)->with('success', 'Order has been received.');
    }
}

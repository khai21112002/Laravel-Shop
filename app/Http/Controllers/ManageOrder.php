<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Statistic;
use Illuminate\Http\Request;
use PHPUnit\Framework\Attributes\Group;

class ManageOrder extends Controller
{
    
    /**
     * mapping for displaying string in blade instead of the integer in database
     */

    protected function StatusMapping($statusInteger) 
    {
        $statusMapping = [
            0 => 'Pending',
            1 => 'Processing',
            2 => 'Completed',
            3 => 'Cancelled',
        ];
        return $statusMapping[$statusInteger] ?? 'unknow status';
    }

    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $orders = Order::with('orderDetails')->paginate(2);
        foreach ($orders as $order) {
            $order->status = $this->statusMapping($order->status); 
        }
        return view('orders', compact('orders'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * if the status is 
     */
    public function update(Request $request, string $id)
    {
        $validateData = $request->validate([
            'status' => "required|integer|in:0,1,2,3",
        ]);

        $order = Order::findOrFail($id);
        $order->update(['status' => $validateData['status']]);

        if ($validateData['status'] == 3) {
            return $this->cancelOrder();
        }

        if ($validateData['status'] == 2) {
            return $this->processOrderCompletion($order);
        }

        return redirect()->back()->with('success', 'Order status has been changed successfully.');
    }

    /**
     * Cancel the order along its details
     */
    private function cancelOrder()
    {
        

        return redirect()->back()->with('success', 'Order has been cancelled and removed');
    }

    /**
     * loop through the details order and if there is not enough quantity for the order , cancel the order 
     * if enough then proceed the order 
     */
    private function processOrderCompletion(Order $order)
    {
        $allProductsAvailable = true;

        foreach ($order->orderDetails as $orderDetail) {
            $product = Product::where('name', $orderDetail->product_name)->first();

            if ($product) {
                if ($product->stock >= $orderDetail->quantity) {
                    $this->updateStockAndCreateStatistic($product, $orderDetail);
                } else {
                    $allProductsAvailable = false;
                    break; 
                }
            }
        }

        if (!$allProductsAvailable) {
            return $this->cancelOrder();
        }

        return redirect()->back()->with('success', 'Order status has been changed successfully.');
    }

    /**
     * if the order is status 2 and there are enough quantity in the sotck then minus the order details quantity in the stock 
     *  and create statistic 
     */
    private function updateStockAndCreateStatistic(Product $product, OrderDetail $orderDetail)
    {
        $product->decrement('stock', $orderDetail->quantity);

        Statistic::create([
            'product_name' => $orderDetail->product_name,
            'order_id' => $orderDetail->order_id,
            'total_order' => $orderDetail->quantity * $orderDetail->price,
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
    }
}

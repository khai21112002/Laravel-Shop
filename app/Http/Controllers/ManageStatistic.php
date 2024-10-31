<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Statistic;
use App\Models\Product;
use Illuminate\Support\Carbon;

class ManageStatistic extends Controller
{
    /**
     * if the order details with completed status take it
     *
     */
    public function hot_item()
    {
        $completed_orders = Order::with('orderDetails')->where('status', 2)->get();

        $product_quantities = $completed_orders->flatMap(function($order) {
                return $order->orderDetails;
            })
            ->groupBy('product_name')
            ->map(function($details) {
                return $details->sum('quantity');
            });

        $hot_items = $product_quantities->sortDesc()->take(3);

        return $hot_items;
    }

    public function calculateCurrentYearIncome()
    {
        $currentYear = Carbon::now()->year;
        $income = Statistic::whereYear('created_at', $currentYear)->sum('total_order');
        return $income;
    }

    public function calculateCurrentMonthIncome()
    {
        $currentMonth = Carbon::now()->month;
        $income = Statistic::whereMonth('created_at', $currentMonth)->sum('total_order');
        return $income;
    }

    public function getNewItems() {
        $newproduct = Product::orderBy('created_at', 'desc')->take(3)->get();
        return $newproduct;
    }

    public function getYearlyIncome()
    {

        $records = Statistic::select('created_at','total_order')->get();
        $group_year = $records->groupBy(function($record) {
            return Carbon::parse($record->created_at)->format('Y');
        });
        $yearlyIncome = $group_year->map(function($eachYear) {
            return $eachYear->sum('total_order');
        });
        return $yearlyIncome;
    }

    public function getMontlyIncome()
    {
        $records = Statistic::select('created_at', 'total_order')->get();
        $group_month = $records->groupBy(function($record) {
            return Carbon::parse($record->created_at)->format('M');
        });

        $monthlyIncome = $group_month->map(function($eachMonth) {
            return $eachMonth->sum('total_order');
        });

        return $monthlyIncome;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $monthlyIncome = $this->calculateCurrentMonthIncome();
        $yearlyIncome = $this->calculateCurrentYearIncome();
        $hotItems = $this->hot_item();
        $newProducts = $this->getNewItems();
        $yearlyIncomeData = $this->getYearlyIncome();
        $monthlyIncomeData = $this->getMontlyIncome();

        // Return the dashboard view with all the gathered data
        return view('dashboard', compact(
            'monthlyIncome',
            'yearlyIncome',
            'hotItems',
            'newProducts',
            'yearlyIncomeData',
            'monthlyIncomeData'
        ));
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
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

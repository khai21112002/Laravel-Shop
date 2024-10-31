<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    use HasFactory;

    protected $table = 'statistics';

    protected $primaryKey = 'id';

    protected $fillable = [
        'product_name',
        'order_id',
        'total_order',
    ];

    public function order() 
    {
        return $this->belongsTo(Order::class);
    }

    public function orderDetail()
    {
        return $this->belongsTo(OrderDetail::class , 'order_id', 'order_id');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';

    protected $primaryKey = 'id';


    protected $fillable = [
        'user_id',
        'fullname',
        'email',
        'received_address',
        'phone',
        'order_code',
        'total_amount',
        'status',
        'payment_method',
    ];


    public function user() 

    {
        return $this->belongsTo(User::class);
    }
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
    public function statistics() 
    {
        return $this->hasMany(Statistic::class);
    }
}

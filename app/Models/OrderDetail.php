<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table = 'order_details';

    protected $primaryKey = 'id';


    protected $fillable = [
        'order_id',
        'product_img',
        'product_name',
        'quantity',
        'price',
    ];


    public function productImage() 
    {
        return $this->belongsToMany(ProductImage::class);
    }
    

    public function order() 
    {
        return $this->belongsTo(Order::class);
    }
}

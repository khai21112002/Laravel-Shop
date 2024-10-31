<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    protected $table = 'product_images';

    protected $primaryKey = 'id';


    protected $fillable = [
        'product_id',
        'img_url',
    ];

    public function orderDetail()
    {
        return $this->belongsToMany(OrderDetail::class);
    }


    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

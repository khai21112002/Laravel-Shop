<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $primaryKey = 'id';


    protected $fillable = [
        'category_id',
        'name',
        'slug',

        'description',
        'price',
        'stock',
        'is_hot',
        'is_new',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            $product->slug = Str::slug($product->name);
        });
    }

    public function productImages() 
    {
        return $this->hasMany(ProductImage::class);
    }

    public function statistics() 
    {
        return $this->hasMany(Statistic::class);
    }


    public function category() 
    {
        return $this->belongsTo(Category::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

}

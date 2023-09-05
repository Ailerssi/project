<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'cart_id',
        'product_id',
        'title',
        'new_price',
        'qty',
        'img',
    ];

    // Определите отношение к модели Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    // Определите отношение к модели Cart
    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id');
    }
}

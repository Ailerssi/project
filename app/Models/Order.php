<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public function orderedProducts()
    {
        return $this->hasMany(OrderedProduct::class);
    }
    public function cartItems()
    {
        return $this->hasMany(CartItem::class, 'cart_id');
    }
}

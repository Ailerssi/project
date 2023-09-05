<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\OrderedProduct;


class OrderController extends Controller
{
    public function createOrder(Request $request)
    {
        $user = auth()->user();
        // Получите содержимое корзины текущего пользователя и сохраните его в заказе
        $userCart = Cart::where('user_id', $user->id)->first();
        // Получите содержимое корзины текущего пользователя и сохраните его в заказе
        $cartItems = CartItem::where('cart_id', $userCart->id)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->back();
        }
        $order = new Order();
        $order->user_id = $user->id;
        $order->name = $user->name;
        $order->save();

        if ($userCart) {
            foreach ($cartItems as $cartItem) {
                // Создайте запись о заказанном товаре
                $orderedProduct = new OrderedProduct();
                $orderedProduct->order_id = $order->id;
                $orderedProduct->product_id = $cartItem->product_id;
                $orderedProduct->quantity = $cartItem->qty;
                $orderedProduct->save();
            }
            // Очистите корзину пользователя
            CartItem::where('cart_id', $userCart->id)->delete();
        }

        // Очистите корзину пользователя
        CartItem::where('cart_id', $user->id)->delete();

        return redirect()->back();
    }
}

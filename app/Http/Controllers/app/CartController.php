<?php

namespace App\Http\Controllers\app;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\Post;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = auth()->id();
        $cartModel = Cart::where('user_id', $userId)->first();

        $posts = Post::orderBy('created_at', 'desc')->get();

        $categories = Category::withCount(['products' => function ($query) {
            $query->where('is_hidden', true);
        }])->orderBy('created_at', 'desc')->get();
        $cartQuantity = 0;
        if (Auth::check()) {
            $userId = Auth::id();
            $cartItems = CartItem::where('cart_id', $cartModel->id)->get();
            $userCart = Cart::where('user_id', $userId)->first();
            if ($userCart) {
                $cartQuantity = CartItem::where('cart_id', $userCart->id)->sum('qty');
            }
        } else{
            $items = \Cart::session($_COOKIE['cart_id'])->getContent();
            $cart_id = isset($_COOKIE['cart_id']) ? $_COOKIE['cart_id'] : uniqid();
            setcookie('cart_id', $cart_id);
            \Cart::session($cart_id);
            return view('app.cart.index', [
                'categories' => $categories,
                'posts'=> $posts,
                'cartQuantity' => $cartQuantity,
                'items' => $items,
            ]);
        }
        return view('app.cart.index', [
            'categories' => $categories,
            'posts'=> $posts,
            'cartQuantity' => $cartQuantity,
            'cartItems' => $cartItems,
        ]);
    }
    public function addToCart(Request $request){
        $product = Product::where('id', $request->id)->first();
        // Проверяем, авторизирован ли пользователь
        if(auth()->check()) {
            $userId = auth()->id();
            \Cart::session($userId); // Используем id авторизированного пользователя вместо 'cart_id'

            $cartModel = Cart::where('user_id', $userId)->first();

            if (!$cartModel) {
                // Если корзины пользователя нет, создаем ее
                $cartModel = new Cart();
                $cartModel->user_id = $userId;
                $cartModel->save();
            }
        } else {
            // Если пользователь не авторизирован, то генерируем 'cart_id' или используем его из cookie
            $cart_id = isset($_COOKIE['cart_id']) ? $_COOKIE['cart_id'] : uniqid();
            setcookie('cart_id', $cart_id);
            \Cart::session($cart_id);
        }

        \Cart::add([
            'id' => $product->id,
            'name' => $product->title,
            'price' => $product->new_price ? $product->new_price : $product->price,
            'quantity' => (int) $request->qty,
            'attributes' => [
                'img' => $product->img,
            ],

        ]);
        if (auth()->check()) {
            foreach (\Cart::getContent() as $item) {
                // Проверяем, есть ли запись о товаре с таким же product_id в базе данных
                $existingCartItem = CartItem::where('cart_id', $cartModel->id)
                    ->where('product_id', $item->id)
                    ->first();

                if ($existingCartItem) {
                    // Обновляем количество товара
                    $existingCartItem->qty = $item->quantity;
                    $existingCartItem->save();
                } else {
                    // Создаем новую запись о товаре
                    $cartItem = new CartItem([
                        'cart_id' => $cartModel->id,
                        'product_id' => $item->id,
                        'title' => $item->name,
                        'new_price' => $item->price,
                        'qty' => $item->quantity,
                        'img' => $item->attributes['img'],
                    ]);
                    $cartItem->save();
                }
            }
        }

        return response()->json(\Cart::getContent());
    }

    public function clearCart(Request $request)
    {
        // Получаем текущего авторизированного пользователя, если есть
        $userId = auth()->check() ? auth()->id() : null;

        if (auth()->check()) {
            // Если пользователь авторизован, получаем его корзину
            $userCart = Cart::where('user_id', $userId)->first();

            if ($userCart) {
                // Получаем идентификатор корзины пользователя
                $cartId = $userCart->id;

                // Удаляем все продукты из корзины
                CartItem::where('cart_id', $cartId)->delete();
            }
        } else {
            // Если пользователь не авторизирован, то генерируем 'cart_id' или используем его из cookie
            $cart_id = isset($_COOKIE['cart_id']) ? $_COOKIE['cart_id'] : uniqid();
            setcookie('cart_id', $cart_id);
            \Cart::session($cart_id)->clear();
        }

        return redirect()->back()->with('success', 'Корзина успешно очищена.');
    }





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCartRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCartRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCartRequest  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCartRequest $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        //
    }
}

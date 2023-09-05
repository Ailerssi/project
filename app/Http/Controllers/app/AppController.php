<?php

namespace App\Http\Controllers\app;

use App\Http\Controllers\Controller;
use App\Models\app\App;
use App\Models\Category;
use App\Models\Post;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class AppController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        $categories = Category::withCount(['products' => function ($query) {
            $query->where('is_hidden', true);
        }])->orderBy('created_at', 'desc')->get();
        $products = Product::where('is_hidden', true)->get();
        $products_hide = Product::where('is_hidden', false)->get();;
        // Получить общее количество товаров в корзине текущего пользователя из базы данных
        $cartQuantity = 0;
        if (Auth::check()) {
            $userId = Auth::id();
            $userCart = Cart::where('user_id', $userId)->first();
            if ($userCart) {
                $cartQuantity = CartItem::where('cart_id', $userCart->id)->sum('qty');
            }
        }

        return view('app.home.index', [
            'categories' => $categories,
            'posts'=> $posts,
            'cartQuantity' => $cartQuantity,
            'products' => $products,
            'products_hide' =>$products_hide,
        ]);

    }
    public function show_category(Category $category)
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        $categories = Category::withCount(['products' => function ($query) {
            $query->where('is_hidden', true);
        }])->orderBy('created_at', 'desc')->get();
        $categories->title = $category->title;

        // Получить общее количество товаров в корзине текущего пользователя из базы данных
        $cartQuantity = 0;
        if (Auth::check()) {
            $userId = Auth::id();
            $userCart = Cart::where('user_id', $userId)->first();
            if ($userCart) {
                $cartQuantity = CartItem::where('cart_id', $userCart->id)->sum('qty');
            }
        }
        $products = $category->products()->where('is_hidden', true)->get();
        return view('app.category.show', [
            'categories' => $categories,
            'products' => $products,
            'posts' => $posts,
            'cartQuantity' => $cartQuantity,
        ]);
    }

    public function show_product(Product $product)
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        $products = $product->category->products()->where('is_hidden', true)->get();

        // Получить общее количество товаров в корзине текущего пользователя из базы данных
        $cartQuantity = 0;
        if (Auth::check()) {
            $userId = Auth::id();
            $userCart = Cart::where('user_id', $userId)->first();
            if ($userCart) {
                $cartQuantity = CartItem::where('cart_id', $userCart->id)->sum('qty');
            }
        }

        $photosArray = json_decode($product->photos, true);
        $categories = Category::withCount(['products' => function ($query) {
            $query->where('is_hidden', true);
        }])->orderBy('created_at', 'desc')->get();

        return view('app.product.show', [
            'categories' => $categories,
            'product' => $product,
            'products' => $products,
            'posts' => $posts,
            'photosArray' => $photosArray,
            'cartQuantity' => $cartQuantity,
        ]);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\app\App  $app
     * @return \Illuminate\Http\Response
     */
    public function show(App $app)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\app\App  $app
     * @return \Illuminate\Http\Response
     */
    public function edit(App $app)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\app\App  $app
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, App $app)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\app\App  $app
     * @return \Illuminate\Http\Response
     */
    public function destroy(App $app)
    {
        //
    }
}

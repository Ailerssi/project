<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $posts_count = Post::all()->count();
        $order_count = Order::all()->count();
        $user_count = User::all()->count();

        return view('admin.home.index', [
            'posts_count' => $posts_count,
            'order_count' => $order_count,
            'user_count' => $user_count,
        ]);
    }
}


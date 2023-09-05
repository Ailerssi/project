<?php

namespace App\Http\Controllers\app;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{

    public function query(Request $request)
    {
        $input = $request->all();
        $data = Product::select('id', 'title')
            ->where("title", "like", "%{$input['query']}%")
            ->where('is_hidden', true)
            ->get();

        return response()->json($data);
    }


}

<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('created_at', 'DESC')->get();
        $categories = Category::orderBy('created_at', 'DESC')->get();
        return view('admin.product.index',[
            'products' => $products,
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('created_at', 'DESC')->get();

        return view('admin.product.create',[
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $product = new Product();
        $product->title = $request->title;
        $product->is_hidden = $request->has('is_hidden');
        $product->price = $request->price;
        $product->old_price = $request->old_price;
        $product->little_description = $request->little_description;
        $product->description = $request->description;
        $product->information = $request->information;
        $product->img = $request->img;
        $product->cat_id = $request->cat_id;

        if ($request->hasFile('photos')) {
            $uploadedPhotoPaths = [];
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('photos', 'photos');
                $uploadedPhotoPaths[] = $path;
            }
            $product->photos = json_encode($uploadedPhotoPaths);
        }
        $product->save();


        return redirect()->back()->withsuccess('Товар был успешно добавлен');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $photosArray = json_decode($product->photos, true);

        $categories = Category::orderBy('created_at', 'DESC')->get();
//        dd($photosArray);
        return view('admin.product.edit',[
            'categories' => $categories,
            'product' => $product,
            'photosArray' => $photosArray,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->title = $request->title;
        $product->is_hidden = $request->has('is_hidden');
        $product->price = $request->price;
        $product->old_price = $request->old_price;
        $product->little_description = $request->little_description;
        $product->description = $request->description;
        $product->information = $request->information;
        $product->img = $request->img;
        $product->cat_id = $request->cat_id;

        if ($request->hasFile('photos')) {
            $uploadedPhotoPaths = [];
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('photos', 'photos');
                $uploadedPhotoPaths[] = $path;
            }
            $product->photos = json_encode($uploadedPhotoPaths);
        }
        $product->save();

        return redirect()->back()->withsuccess('Товар был успешно изменён');
    }
    public function hide(UpdateProductRequest $request, Product $product)
    {
        $product->is_hidden = $request->has('is_hidden');
        $product->price = $request->price;
        $product->old_price = $request->old_price;
        $product->save();
        return redirect()->back()->withsuccess('Товар был успешно изменён');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->back()->withsuccess('Товар был успешно удалён!');
    }
}

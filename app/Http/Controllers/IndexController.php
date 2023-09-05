<?php

namespace App\Http\Controllers;

use App\Models\app\index;
use App\Http\Requests\StoreindexRequest;
use App\Http\Requests\UpdateindexRequest;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreindexRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreindexRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\app\index  $index
     * @return \Illuminate\Http\Response
     */
    public function show(index $index)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\app\index  $index
     * @return \Illuminate\Http\Response
     */
    public function edit(index $index)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateindexRequest  $request
     * @param  \App\Models\app\index  $index
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateindexRequest $request, index $index)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\app\index  $index
     * @return \Illuminate\Http\Response
     */
    public function destroy(index $index)
    {
        //
    }
}

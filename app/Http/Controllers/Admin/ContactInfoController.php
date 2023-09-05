<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactInfoRequest;
use App\Http\Requests\UpdateContactInfoRequest;
use App\Models\ContactInfo;

class ContactInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('admin.contact.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.contact.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreContactInfoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContactInfoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ContactInfo  $contactInfo
     * @return \Illuminate\Http\Response
     */
    public function show(ContactInfo $contactInfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ContactInfo  $contactInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(ContactInfo $contactInfo)
    {
        return view('admin.contact.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateContactInfoRequest  $request
     * @param  \App\Models\ContactInfo  $contactInfo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateContactInfoRequest $request, ContactInfo $contactInfo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ContactInfo  $contactInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContactInfo $contactInfo)
    {
        //
    }
}

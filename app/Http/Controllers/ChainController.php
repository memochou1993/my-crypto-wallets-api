<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreChainRequest;
use App\Http\Requests\UpdateChainRequest;
use App\Models\Chain;

class ChainController extends Controller
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
     * @param  \App\Http\Requests\StoreChainRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreChainRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Chain  $chain
     * @return \Illuminate\Http\Response
     */
    public function show(Chain $chain)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Chain  $chain
     * @return \Illuminate\Http\Response
     */
    public function edit(Chain $chain)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateChainRequest  $request
     * @param  \App\Models\Chain  $chain
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateChainRequest $request, Chain $chain)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Chain  $chain
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chain $chain)
    {
        //
    }
}

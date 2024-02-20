<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Aquaculture;
use Illuminate\Http\Request;

class AquacultureController extends Controller
{
    public function index()
    {
        // $aquacultures = Aquaculture::orderBy('created_at', 'DESC')->get();
        return view('pages.aquaculture.index');
    }

    public function create()
    {
        return view('pages.aquaculture.create');
    }
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

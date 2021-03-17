<?php

namespace App\Http\Controllers;

use App\SeoMagazine;
use Illuminate\Http\Request;

class SeoMagazineController extends Controller
{

    public function index()
    {
        $seo = SeoMagazine::first();

        return view('admin.seo.edit-seo', compact('seo'));
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
     * @param  \App\SeoMagazine  $seoMagazine
     * @return \Illuminate\Http\Response
     */
    public function show(SeoMagazine $seoMagazine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SeoMagazine  $seoMagazine
     * @return \Illuminate\Http\Response
     */
    public function edit(SeoMagazine $seoMagazine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SeoMagazine  $seoMagazine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SeoMagazine $seoMagazine)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SeoMagazine  $seoMagazine
     * @return \Illuminate\Http\Response
     */
    public function destroy(SeoMagazine $seoMagazine)
    {
        //
    }
}

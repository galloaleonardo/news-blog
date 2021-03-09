<?php

namespace App\Http\Controllers;

use App\GoogleAds;
use App\Languages;
use App\Settings;
use Illuminate\Http\Request;

class GoogleAdsController extends Controller
{
    public function index()
    {
        $googleAds = GoogleAds::first();

        return view('admin.google-ads.edit-google-ads', compact('googleAds'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GoogleAds  $googleAds
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $fields = $request->all();
        $googleAds = GoogleAds::first();

        $fields['active'] = $request->has('active');

        $googleAds->update($fields);

        return redirect(route('google-ads.index'))->with('success', 'Google Ads updated successfuly.');
    }
}

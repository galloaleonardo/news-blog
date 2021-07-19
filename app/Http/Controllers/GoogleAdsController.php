<?php

namespace App\Http\Controllers;

use App\Models\GoogleAds;
use App\Models\Languages;
use App\Models\Settings;
use Illuminate\Http\Request;

class GoogleAdsController extends Controller
{
    public function index()
    {
        $googleAds = GoogleAds::first();

        return view('admin.google-ads.edit-google-ads', compact('googleAds'));
    }

    public function update(Request $request)
    {
        $fields = $request->all();
        $googleAds = GoogleAds::first();

        $fields['active'] = $request->has('active');

        $googleAds->update($fields);

        return redirect(route('google-ads.index'))
            ->with('success', trans('admin.updated_successfully', [
                'object' => trans('admin.google_ads')
            ]));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\GoogleAnalytics;
use Illuminate\Http\Request;

class GoogleAnalyticsController extends Controller
{
    public function index()
    {
        $googleAnalytics = GoogleAnalytics::first();

        return view('admin.google-analytics.edit-google-analytics', compact('googleAnalytics'));
    }

    public function update(Request $request)
    {
        $fields = $request->all();
        $googleAds = GoogleAnalytics::first();

        $fields['active'] = $request->has('active');

        $googleAds->update($fields);

        return redirect(route('google-analytics.index'))
            ->with('success', trans('admin.updated_successfully', [
                'object' => trans('admin.google_ads')
            ]));
    }
}

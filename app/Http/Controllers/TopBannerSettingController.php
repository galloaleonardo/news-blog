<?php

namespace App\Http\Controllers;

use App\Models\TopBannerSetting;
use Illuminate\Http\Request;

class TopBannerSettingController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TopBannerSetting  $topBannerSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TopBannerSetting $topBannerSetting)
    {
        $settings = TopBannerSetting::first();

        $fields['active'] = $request->has('active');
        $fields['keep_on_top_when_scrolling'] = $request->has('keep_on_top_when_scrolling');

        $settings->update($fields);

        return redirect(route('top-banner.index'))
            ->with('success', trans('admin.updated_successfully', [
                'object' => trans('admin.settings')
            ]));
    }
}

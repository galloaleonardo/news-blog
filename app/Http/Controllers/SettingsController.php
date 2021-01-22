<?php

namespace App\Http\Controllers;

use App\Languages;
use App\Settings;
use Hamcrest\Core\Set;
use Illuminate\Http\Request;

class SettingsController extends Controller
{

    public function index()
    {
        $settings = Settings::first();
        $languages = Languages::all();

        return view('admin.settings.edit-settings', compact('settings', 'languages'));
    }

    public function update(Request $request)
    {
        $fields = $request->all();
        $settings = Settings::first();

        $settings->update($fields);

        return redirect(route('settings.index'))->with('success', 'Settings updated successfuly.');
    }
}

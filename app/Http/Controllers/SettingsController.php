<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Languages;
use App\Settings;
use Hamcrest\Core\Set;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;

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

        if ($request->hasFile('company_logo_link')) {
            $request->validate(['image_link' => $this->validateImage()]);
            $fields['company_logo_link'] = $this->uploadImageAndReturnName($request->file('company_logo_link'));
        }

        $fields['use_logo_by_default'] = $request->has('use_logo_by_default');

        $settings->update($fields);

        return redirect(route('settings.index'))
            ->with('success', trans('admin.updated_successfully', [
                'object' => trans('admin.settings')
            ]));
    }

    private function validateImage()
    {
        return [
            'image',
            'mimes:jpeg,jpg,png',
            'max:800',
            'dimensions:max_width=2000, max_height=2000'
        ];
    }

    private function uploadImageAndReturnName(UploadedFile $image)
    {
        $name = 'logo';
        $png_name = "{$name}.png";
        $path = public_path('images/logo/');

        Helper::checkPath([$path]);

        Image::make($image)
            ->encode('png', 60)
            ->resize(160, null, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->save($path . $png_name);

        return $png_name;
    }
}

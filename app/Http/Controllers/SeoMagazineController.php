<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\SeoMagazine;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;

class SeoMagazineController extends Controller
{

    public function index()
    {
        $seo = SeoMagazine::first();

        return view('admin.seo.edit-seo', compact('seo'));
    }


    public function update(Request $request, SeoMagazine $seo)
    {
        $attributes = $request->all();

        $request->validate([
            'page_title' => ['required', 'max:100'],
            'page_description' => ['required', 'max:255'],
            'page_type' => 'required',
            'twitter_user' => 'nullable'
        ]);

        if ($request->hasFile('image_link')) {
            $request->validate(['image_link' => $this->validateImage()]);
            $attributes['image_link'] = $this->uploadImageAndReturnName($request->file('image_link'));
        }

        $seo->update($attributes);

        return redirect(route('seo.index'))
            ->with('success', trans('admin.updated_successfully', [
                'object' => trans('admin.seo')
            ]));
    }

    private function uploadImageAndReturnName(UploadedFile $image)
    {
        $name = Helper::getRandomNameImage();
        $jpg_name = "{$name}.jpg";
        $path_small = public_path('images/seo/small/');

        Helper::checkPath([$path_small]);

        Image::make($image)
            ->encode('jpg', 60)
            ->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->save($path_small . $jpg_name);

        return $jpg_name;
    }

    private function validateImage()
    {
        $validate = [
            'nullable',
            'image',
            'mimes:jpeg,jpg,png',
            'max:800',
            'dimensions:max_width=1500, max_height=1500'
        ];

        return $validate;
    }
}

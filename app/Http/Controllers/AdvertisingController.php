<?php

namespace App\Http\Controllers;

use App\Advertising;
use App\Helpers\Helper;
use App\News;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;

class AdvertisingController extends Controller {

    public function index()
    {
        $advertisements = Advertising::paginate(10);

        return view('admin.advertisements.index-advertisements', compact('advertisements'));
    }

    public function create()
    {
        return view('admin.advertisements.create-advertisements');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'min:5', 'max:100'],
            'image_link' => $this->validateImage()
        ]);

        $attributes = $request->all();

        $attributes['active']     = $request->has('active') ? true : false;
        $attributes['image_link'] = $this->uploadImageAndReturnName($request->file('image_link'));

        Advertising::create($attributes);

        return redirect('/advertisements');
    }

    public function show(Advertising $advertising)
    {
        return view('admin.advertisements.show-advertisements', compact('advertising'));
    }

    public function edit(Advertising $advertising)
    {
        //
    }

    public function update(Request $request, Advertising $advertising)
    {
        //
    }

    public function destroy(Advertising $advertising)
    {
        //
    }

    private function uploadImageAndReturnName(UploadedFile $image)
    {
        $name       = Helper::getRandomNameImage();
        $jpg_name   = "{$name}.jpg";
        $path_large = public_path('images/advertisements/');

        Helper::checkPath([$path_large]);

        Image::make($image)
             ->encode('jpg', 60)
             ->save($path_large . $jpg_name);

        return $jpg_name;
    }

    private function validateImage()
    {
        $validate = [
            'required',
            'image',
            'mimes:jpeg,jpg,png',
            'max:800',
            'dimensions:max_width=1500, max_height=1500'
        ];

        return $validate;
    }
}

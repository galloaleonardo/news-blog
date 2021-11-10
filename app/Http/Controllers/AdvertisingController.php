<?php

namespace App\Http\Controllers;

use App\Models\Advertising;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;

class AdvertisingController extends Controller
{

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

        $attributes['active'] = $request->has('active') ? true : false;
        $attributes['image_link'] = $this->uploadImageAndReturnName($request->file('image_link'));

        Advertising::create($attributes);

        return redirect(route('advertisements.index'))
            ->with('success', trans('admin.created_successfully', [
                'object' => trans('admin.advertisings')
            ]));
    }

    public function edit(Advertising $advertising)
    {
        return view('admin.advertisements.edit-advertisements', compact('advertising'));
    }

    public function update(Request $request, Advertising $advertising)
    {
        $attributes = $request->all();

        $request->validate(['title' => ['required', 'min:5', 'max:100']]);

        if ($request->hasFile('image_link')) {
            $request->validate(['image_link' => $this->validateImage()]);
            $attributes['image_link'] = $this->uploadImageAndReturnName($request->file('image_link'));
        }

        $attributes['active'] = $request->has('active') ? true : false;

        $advertising->update($attributes);

        return redirect(route('advertisements.index'))
            ->with('success', trans('admin.updated_successfully', [
                'object' => trans('admin.advertisings')
            ]));
    }

    public function destroy(Advertising $advertising)
    {
        $advertising->delete();
        return redirect(route('advertisements.index'))
            ->with('success', trans('admin.deleted_successfully', [
                'object' => trans('admin.advertisings')
            ]));
    }

    private function uploadImageAndReturnName(UploadedFile $image)
    {
        $name = Helper::getRandomImageName();
        $jpg_name = "{$name}.jpg";
        $path_large = public_path('images/announcements/');

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
            'mimes:jpeg,jpg,png'
        ];

        return $validate;
    }
}

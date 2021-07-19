<?php

namespace App\Http\Controllers;

use App\Models\Advertising;
use App\Helpers\Helper;
use App\Models\TopBanner;
use App\Models\TopBannerSetting;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;

class TopBannerController extends Controller
{

    public function index()
    {
        $topBannerSetting = TopBannerSetting::first();

        $topBanners = TopBanner::paginate(10);

        return view('admin.top-banner.index-top-banner', compact('topBannerSetting', 'topBanners'));
    }

    public function create()
    {
        return view('admin.top-banner.create-top-banner');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'min:5', 'max:100'],
            'image_link' => ImageService::validateImage()
        ]);

        $attributes = $request->all();

        $attributes['active'] = $request->has('active') ? true : false;
        $attributes['image_link'] = ImageService::uploadAndReturnName($request->file('image_link'), 'top-banners');

        TopBanner::create($attributes);

        return redirect(route('top-banner.index'))
            ->with('success', trans('admin.created_successfully', [
                'object' => trans('admin.top_banner')
            ]));
    }

    public function show(TopBanner $topBanner)
    {
        return view('admin.top-banner.show-top-banner', compact('topBanner'));
    }

    public function edit(TopBanner $topBanner)
    {
        return view('admin.top-banner.edit-top-banner', compact('topBanner'));
    }

    public function update(Request $request, TopBanner $topBanner)
    {
        $attributes = $request->all();

        $request->validate(['title' => ['required', 'min:5', 'max:100']]);

        if ($request->hasFile('image_link')) {
            $request->validate(['image_link' => ImageService::validateImage()]);
            $attributes['image_link'] = ImageService::uploadAndReturnName($request->file('image_link'), 'top-banners');
        }

        $attributes['active'] = $request->has('active') ? true : false;

        $topBanner->update($attributes);

        return redirect(route('top-banner.index'))
            ->with('success', trans('admin.updated_successfully', [
                'object' => trans('admin.top_banner')
            ]));
    }

    public function destroy(TopBanner $topBanner)
    {
        $topBanner->delete();
        return redirect(route('top-banner.index'))
            ->with('success', trans('admin.deleted_successfully', [
                'object' => trans('admin.top_banner')
            ]));
    }
}

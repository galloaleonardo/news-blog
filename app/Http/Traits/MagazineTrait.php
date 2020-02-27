<?php


namespace App\Http\Traits;


use App\Advertising;
use App\News;

trait MagazineTrait
{
    public function getFeaturedNews()
    {
        return News::where('featured', true)->limit(6)->get();
    }

    public function getRecentNews()
    {
        return News::where('featured', false)->limit(5)->get();
    }

    public function getPopularNews()
    {
        return News::limit(4)->orderBy('views', 'desc')->get();
    }

    public function getAdvertising()
    {
        return Advertising::all();
    }
}
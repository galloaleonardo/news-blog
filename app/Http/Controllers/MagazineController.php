<?php

namespace App\Http\Controllers;

use App\Http\Traits\MagazineTrait;
use App\News;
use Illuminate\Support\Collection;

class MagazineController extends Controller
{

    use MagazineTrait;

    public function index()
    {
        $featuredNews = $this->getFeaturedNews();
        $recentNews = $this->getRecentNews();
        $popularNews = $this->getPopularNews();
        $advertising = $this->getAdvertising();

        return view('news.template.magazine',
            compact('featuredNews', 'recentNews', 'popularNews', 'advertising'));
    }

    public function show(News $news)
    {
        dd($news);
    }
}

<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Traits\MagazineTrait;
use App\News;

class MagazineController extends Controller
{

    use MagazineTrait;

    public function index()
    {
        $featuredNews = $this->getFeaturedNews();
        $recentNews = $this->getRecentNews();
        $popularNews = $this->getPopularNews();
        $advertising = $this->getAdvertising();
        $featuredNewsCategories = $this->getFeaturedCategories();

        return view('magazine.template.magazine',
            compact('featuredNews', 'recentNews', 'popularNews', 'advertising', 'featuredNewsCategories'));
    }

    public function show(int $id, string $title)
    {
        $news = News::findOrFail($id);

        Helper::getDateForPost($news->updated_at);        

        views($news)->record();

        return view('magazine.template.post', compact('news'));
    }
}

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
        $advertising = $this->getAdvertising();
        $featuredNews = $this->getFeaturedNews();
        $recentNews = $this->getRecentNews();
        $featuredNewsCategories = $this->getFeaturedCategories();
        $popularNews = $this->getPopularNews([$featuredNews, $recentNews, $featuredNewsCategories]);

        return view('magazine.template.magazine',
            compact('advertising', 'featuredNews', 'recentNews', 'featuredNewsCategories', 'popularNews'));
    }

    public function show(int $id, string $title)
    {
        $news = News::findOrFail($id);
        $popularNews = $this->getPopularNews([]);
        $suggestedNews = $this->suggestedNews($news->id, $news->category_id);

        Helper::getDateForPost($news->updated_at);        

        views($news)->record();

        return view('magazine.template.post', compact('news', 'popularNews', 'suggestedNews'));
    }
}

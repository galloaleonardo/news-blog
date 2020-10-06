<?php

namespace App\Http\Controllers;

use App;
use App\Helpers\Helper;
use App\Http\Traits\MagazineTrait;
use App\News;

class MagazineController extends Controller
{

    use MagazineTrait;

    public function index()
    {
        $categories = $this->getCategories();
        $advertising = $this->getAdvertising();
        $featuredNews = $this->getFeaturedNews();
        $recentNews = $this->getRecentNews();
        $featuredNewsCategories = $this->getNewsFeaturedCategories();
        $popularNews = $this->getPopularNews([$featuredNews, $recentNews, $featuredNewsCategories]);

        return view('magazine.homepage.index',
            compact('categories', 'advertising', 'featuredNews', 'recentNews', 'featuredNewsCategories', 'popularNews'));
    }

    public function show(int $id, string $title)
    {
        $categories = $this->getCategories();
        $news = News::findOrFail($id);
        $popularNews = $this->getPopularNews([]);
        $suggestedNews = $this->suggestedNews($news->id, $news->category_id);

        Helper::getDateForPost($news->updated_at);        

        views($news)->record();

        return view('magazine.post.index', compact('categories', 'news', 'popularNews', 'suggestedNews'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Traits\MagazineTrait;
use App\News;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;


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

        return view(
            'magazine.homepage.index',
            compact('categories', 'advertising', 'featuredNews', 'recentNews', 'featuredNewsCategories', 'popularNews')
        );
    }

    public function show(int $id, string $title)
    {
        $categories = $this->getCategories();
        $news = News::findOrFail($id);
        $popularNews = $this->getPopularNews([]);
        $suggestedNews = $this->suggestedNews($news->id, $news->category_id);

        Helper::getWrittenDateLanguage($news->updated_at);

        views($news)->record();

        SEOTools::setTitle($news->title);
        SEOTools::setDescription($news->subtitle);
        SEOTools::opengraph()->setUrl('http://current.url.com');
        SEOTools::setCanonical('https://codecasts.com.br/lesson');
        SEOTools::opengraph()->addProperty('type', 'articles');
        SEOTools::twitter()->setSite('@LuizVinicius73');
        SEOTools::jsonLd()->addImage('https://codecasts.com.br/img/logo.jpg');

        return view('magazine.post.index', compact('categories', 'news', 'popularNews', 'suggestedNews'));
    }

    public function all(Request $request)
    {
        $search   = $request->has('search') ? $request->get('search') : null;
        $category = $request->has('category') ? $request->get('category') : null;

        $categories = $this->getCategories();

        $news = $this->getOrSearchAllNews($search, $category);

        return view('magazine.all-news.index', compact('news', 'categories'));
    }
}

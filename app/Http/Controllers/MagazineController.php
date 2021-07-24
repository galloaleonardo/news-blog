<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Traits\MagazineTrait;
use App\Models\News;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
// OR with multi
use Artesaos\SEOTools\Facades\JsonLdMulti;

// OR
use Artesaos\SEOTools\Facades\SEOTools;


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
        $topBanners = $this->getTopBanners();
        $topBannerSetting = $this->getTopBannerSetting();

        $this->setSEOPages();

        return view(
            'magazine.homepage.index',
            compact(
                'categories',
                'advertising',
                'featuredNews',
                'recentNews',
                'featuredNewsCategories',
                'popularNews',
                'topBanners',
                'topBannerSetting'
            )
        );
    }

    public function show(int $id, string $title)
    {
        $categories = $this->getCategories();
        $news = News::findOrFail($id);
        $popularNews = $this->getPopularNews([]);
        $suggestedNews = $this->suggestedNews($news->id, $news->category_id);
        $topBanners = $this->getTopBanners();
        $topBannerSetting = $this->getTopBannerSetting();


        Helper::getWrittenDateLanguage($news->updated_at);

        views($news)->record();

        $this->setSEOPost($news);

        return view('magazine.post.index', compact(
            'categories',
            'news',
            'popularNews',
            'suggestedNews',
            'topBanners',
            'topBannerSetting'
        ));
    }

    public function all(Request $request)
    {
        $search   = $request->has('search') ? $request->get('search') : null;
        $category = $request->has('category') ? $request->get('category') : null;
        $topBanners = $this->getTopBanners();
        $topBannerSetting = $this->getTopBannerSetting();


        $categories = $this->getCategories();

        $news = $this->getOrSearchAllNews($search, $category);

        $this->setSEOPages();

        return view('magazine.all-news.index', compact(
            'news',
            'categories',
            'topBanners',
            'topBannerSetting'
        ));
    }
}

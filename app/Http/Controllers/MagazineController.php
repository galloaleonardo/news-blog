<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Traits\MagazineTrait;
use App\News;
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

        SEOMeta::setTitle($news->title);
        SEOMeta::setDescription($news->subtitle);
        SEOMeta::addMeta('article:published_time', $news->created_at->toW3CString(), 'property');
        SEOMeta::addMeta('article:section', $news->category->name, 'property');

        OpenGraph::setTitle($news->title);
        OpenGraph::setDescription($news->subtitle);
        OpenGraph::setUrl('http://current.url.com');
        OpenGraph::addProperty('type', 'article');
        OpenGraph::addProperty('locale', 'pt-br');
        OpenGraph::addProperty('locale:alternate', ['pt-pt', 'en-us']);

        OpenGraph::addImage(request()->getHttpHost() . '/images/news/small/' .  $news->image_link, ['height' => 300, 'width' => 300]);

        JsonLd::setTitle($news->title);
        JsonLd::setDescription($news->subtitle);
        JsonLd::setType('Article');
        JsonLd::addImage(request()->getHttpHost() . '/images/news/small/' .  $news->image_link);

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

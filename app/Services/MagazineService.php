<?php

namespace App\Services;

use App\Models\News;
use App\Models\SeoMagazine;
use App\Repositories\MagazineRepository;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;

class MagazineService
{
    public function __construct(
        private MagazineRepository $repository
    ) {}

    public function index()
    {
        $featuredNews = $this->repository->getFeaturedNews();
        $recentNews = $this->repository->getRecentNews();
        $featuredNewsCategories = $this->repository->getNewsFeaturedCategories();

        return [
            'categories' => $this->repository->getCategories(),
            'advertising' => $this->repository->getAdvertising(),
            'featuredNews' => $featuredNews,
            'recentNews' => $recentNews,
            'featuredNewsCategories' => $featuredNewsCategories,
            'popularNews' => $this->repository->getPopularNews([$featuredNews, $recentNews, $featuredNewsCategories]),
            'topBanners' => $this->repository->getTopBanners(),
            'topBannerSetting' => $this->repository->getTopBannerSetting(),
        ];
    }

    public function show(int $id)
    {
        $featuredNews = $this->repository->getFeaturedNews();
        $recentNews = $this->repository->getRecentNews();
        $featuredNewsCategories = $this->repository->getNewsFeaturedCategories();
        $news = $this->repository->find($id);

        views($news)->record();

        return [
            'categories' => $this->repository->getCategories(),
            'news' => News::findOrFail($id),
            'featuredNews' => $this->repository->getFeaturedNews(),
            'recentNews' => $this->repository->getRecentNews(),
            'featuredNewsCategories' => $this->repository->getNewsFeaturedCategories(),
            'popularNews' => $this->repository->getPopularNews([$featuredNews, $recentNews, $featuredNewsCategories]),
            'suggestedNews' => $this->repository->suggestedNews($news->id, $news->category_id),
            'topBanners' => $this->repository->getTopBanners(),
            'topBannerSetting' => $this->repository->getTopBannerSetting(),
            'youtubeLinks' => explode(PHP_EOL, $news->youtube_links)
        ];
    }

    public function all($search, $category, $author)
    {
        return [
            'topBanners' => $this->repository->getTopBanners(),
            'topBannerSetting' => $this->repository->getTopBannerSetting(),
            'categories' => $this->repository->getCategories(),
            'news' => $this->repository->getOrSearchAllNews($search, $category, $author)
        ];
    }

    public function setSEOPost(News $news)
    {
        $seo = SeoMagazine::first();

        SEOMeta::setTitle($news->title);
        SEOMeta::setDescription($news->subtitle);
        SEOMeta::addMeta('article:published_time', $news->created_at->toW3CString(), 'property');
        SEOMeta::addMeta('article:section', $news->category->name, 'property');

        OpenGraph::setTitle($news->title);
        OpenGraph::setDescription($news->subtitle);
        OpenGraph::setUrl(request()->getHttpHost());
        OpenGraph::addProperty('type', 'article');
        OpenGraph::addProperty('locale', 'pt-br');
        OpenGraph::addProperty('locale:alternate', ['pt-pt', 'en-us']);
        OpenGraph::addImage(request()->getHttpHost() . '/images/news/small/' . $news->image_link, ['height' => 300, 'width' => 300]);

        JsonLd::setTitle($news->title);
        JsonLd::setDescription($news->subtitle);
        JsonLd::setType($seo->page_type);
        JsonLd::addImage(request()->getHttpHost() . '/images/news/small/' . $news->image_link);
    }

    public function setSEOPages()
    {
        $seo = SeoMagazine::first();

        SEOMeta::setTitle($seo->page_title);
        SEOMeta::setDescription($seo->page_description);
        SEOMeta::setCanonical(request()->getHttpHost());

        OpenGraph::setTitle($seo->page_title);
        OpenGraph::setDescription($seo->page_description);
        OpenGraph::setUrl(request()->getHttpHost());
        OpenGraph::addProperty('type', $seo->page_type);
        OpenGraph::addImage(request()->getHttpHost() . '/images/seo/small/' . $seo->image_link);

        $twitterUser = $seo->twitter_user && substr($seo->twitter_user, 0, 1) !== '@' ? '@' . $seo->twitter_user : $seo->twitter_user;

        TwitterCard::setTitle($seo->page_description);
        TwitterCard::setSite($twitterUser);
        TwitterCard::addImage(request()->getHttpHost() . '/images/seo/small/' . $seo->image_link);

        JsonLd::setTitle($seo->page_title);
        JsonLd::setDescription($seo->page_description);
        JsonLd::addImage(request()->getHttpHost() . '/images/seo/small/' . $seo->image_link);
    }
}

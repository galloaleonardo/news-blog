<?php


namespace App\Http\Traits;


use App\Advertising;
use App\Category;
use App\News;
use App\SeoMagazine;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use CyrildeWit\EloquentViewable\Support\Period;
use CyrildeWit\EloquentViewable\Views;

trait MagazineTrait
{
    public function getFeaturedNews()
    {
        return News::where('featured', true)->limit(6)->get();
    }

    public function getRecentNews()
    {
        return News::where('featured', false)->orderBy('created_at', 'desc')->limit(5)->get();
    }

    public function getCategories()
    {
        return Category::where('displays_in_menu', true)->orderBy('name')->get();
    }

    public function getNewsFeaturedCategories()
    {
        $categories = Category::where('featured', true)->limit(4)->get();

        $category_news_1 = [];

        if (isset($categories[0])) {
            $category_news_1 = News::select('news.*', 'categories.name')
                ->join('categories', 'news.category_id', 'categories.id')
                ->where('categories.id', $categories[0]->id)
                ->where('categories.featured', true)
                ->orderBy('news.created_at', 'desc')
                ->inRandomOrder()
                ->limit(6)
                ->get();
        }

        $category_news_2 = [];

        if (isset($categories[1])) {
            $category_news_2 = News::select('news.*', 'categories.name')
                ->join('categories', 'news.category_id', 'categories.id')
                ->where('categories.id', $categories[1]->id)
                ->where('categories.featured', true)
                ->orderBy('news.created_at', 'desc')
                ->inRandomOrder()
                ->limit(6)
                ->get();
        }

        $category_news_3 = [];

        if (isset($categories[2])) {
            $category_news_3 = News::select('news.*', 'categories.name')
                ->join('categories', 'news.category_id', 'categories.id')
                ->where('categories.id', $categories[2]->id)
                ->where('categories.featured', true)
                ->orderBy('news.created_at', 'desc')
                ->inRandomOrder()
                ->limit(6)
                ->get();
        }

        $category_news_4 = [];

        if (isset($categories[3])) {
            $category_news_4 = News::select('news.*', 'categories.name')
                ->join('categories', 'news.category_id', 'categories.id')
                ->where('categories.id', $categories[3]->id)
                ->where('categories.featured', true)
                ->orderBy('news.created_at', 'desc')
                ->inRandomOrder()
                ->limit(6)
                ->get();
        }

        return [
            'category_1' => $category_news_1,
            'category_2' => $category_news_2,
            'category_3' => $category_news_3,
            'category_4' => $category_news_4
        ];
    }

    public function getPopularNews(array $newsWillBeDisplayed)
    {
        $newsID = [];

        foreach ($newsWillBeDisplayed as $news) {
            if (is_array($news)) {
                foreach ($news as $categoryNews) {
                    array_push($newsID, $categoryNews->pluck('id')->toArray());
                }
            } else {
                array_push($newsID, $news->pluck('id')->toArray());
            }
        }

        $newsID = array_unique(array_merge(...$newsID));

        $news = News::orderByViews('desc', Period::pastDays(90))->whereNotIn('id', $newsID)->limit(4)->get();

        if (!$news->first()) {
            $news = News::orderByViews('desc', Period::pastDays(90))->limit(4)->get();
        }

        return $news;
    }

    public function suggestedNews($id, $category_id)
    {
        return News::where('id', '<>', $id)->where('category_id', $category_id)->orderBy('created_at', 'desc')->limit(2)->get();
    }

    public function getAdvertising()
    {
        return Advertising::where('active', true)->limit(6)->get();
    }

    public function getOrSearchAllNews(?string $search, ?string $category)
    {
        return News::where('active', true)
            ->where(function ($query) use ($search, $category) {
                if ($search) {
                    $query->where('title', 'LIKE', '%' . $search . '%');
                }

                if ($category) {
                    $categoryModel = Category::where('name', $category)->first();

                    if ($categoryModel) {
                        $query->where('category_id', $categoryModel->id);
                    }
                }
            })
            ->orderBy('updated_at', 'desc')
            ->get();
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

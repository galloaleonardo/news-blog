<?php


namespace App\Http\Traits;


use App\Advertising;
use App\Category;
use App\News;
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
}
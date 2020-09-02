<?php


namespace App\Http\Traits;


use App\Advertising;
use App\Category;
use App\News;

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

    public function getPopularNews()
    {
        return News::limit(4)->orderBy('views', 'desc')->get();
    }

    public function getFeaturedCategories()
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

    public function getAdvertising()
    {
        return Advertising::where('active', true)->limit(6)->get();
    }
}
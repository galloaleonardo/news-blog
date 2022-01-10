<?php

namespace App\Repositories;

use App\Models\Advertising;
use App\Models\Author;
use App\Models\Category;
use App\Models\News;
use App\Models\TopBanner;
use App\Models\TopBannerSetting;
use CyrildeWit\EloquentViewable\Support\Period;
use Illuminate\Database\Eloquent\Collection;

class MagazineRepository
{
    public function __construct(
        private News $news,
        private Category $category,
        private Advertising $advertising,
        private Author $author,
        private TopBanner $topBanner,
        private TopBannerSetting $topBannerSetting
    ) {}

    public function find(int $id)
    {
        return $this->news->findOrFail($id);
    }

    public function getFeaturedNews()
    {
        return $this->news->where('featured', true)->limit(6)->get();
    }

    public function getRecentNews()
    {
        return $this->news->where('featured', false)->orderBy('created_at', 'desc')->limit(5)->get();
    }

    public function getCategories()
    {
        return $this->category->where('displays_in_menu', true)->orderBy('name')->get();
    }

    public function getNewsFeaturedCategories()
    {
        $categories = $this->category->where('featured', true)->limit(4)->get();

        $category_news_1 = [];

        if (isset($categories[0])) {
            $category_news_1 = $this->news->select('news.*', 'categories.name')
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
            $category_news_2 = $this->news->select('news.*', 'categories.name')
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
            $category_news_3 = $this->news->select('news.*', 'categories.name')
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
            $category_news_4 = $this->news->select('news.*', 'categories.name')
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
                    if ($categoryNews instanceof Collection) {
                        array_push($newsID, $categoryNews->pluck('id')->toArray());
                    }
                }
            } else {
                if ($news instanceof Collection) {
                    array_push($newsID, $news->pluck('id')->toArray());
                }
            }
        }

        if ($newsID) {
            $newsID = array_unique(array_merge(...$newsID));

            $news = $this->news::orderByViews('desc', Period::pastDays(90))->whereNotIn('id', $newsID)->limit(4)->get();

            if (!$news->first()) {
                $news = $this->news::orderByViews('desc', Period::pastDays(90))->limit(4)->get();
            }

            return $news;
        }

        return [];
    }

    public function suggestedNews($id, $category_id)
    {
        return $this->news->where('id', '<>', $id)->where('category_id', $category_id)->orderBy('created_at', 'desc')->limit(2)->get();
    }

    public function getAdvertising()
    {
        return $this->advertising->where('active', true)->limit(6)->get();
    }

    public function getOrSearchAllNews(?string $search, ?string $category, ?string $author)
    {
        return $this->news->where('active', true)
            ->where(function ($query) use ($search, $category, $author) {
                if ($search) {
                    $query->where('title', 'LIKE', '%' . $search . '%');
                }

                if ($category) {
                    $categoryModel = $this->category->where('name', $category)->first();

                    if ($categoryModel) {
                        $query->where('category_id', $categoryModel->id);
                    }
                }

                if ($author) {
                    $authorModel = $this->author->where('name', $author)->first();

                    if ($authorModel) {
                        $query->where('author_id', $authorModel->id);
                    }
                }
            })
            ->orderBy('updated_at', 'desc')
            ->get();
    }

    public function getTopBanners()
    {
        return $this->topBanner->all();
    }

    public function getTopBannerSetting()
    {
        return $this->topBannerSetting->first();
    }
}

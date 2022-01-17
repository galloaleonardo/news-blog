<?php

namespace App\Repositories;

use App\Models\Advertising;
use App\Models\Author;
use App\Models\Category;
use App\Models\News;
use App\Models\User;

class DashboardRepository
{
    public function __construct(
        private News $news,
        private Category $category,
        private Advertising $advertising,
        private User $user
    ) {}

    public function index()
    {
        return [
            'news' => $this->news->count(),
            'categories' => $this->category->count(),
            'advertisements' => $this->advertising->count(),
            'users' => $this->user->count()
        ];
    }

    public function getNewsOrderByViews()
    {
        return $this->news->orderByViews()->limit(3)->get();
    }
}

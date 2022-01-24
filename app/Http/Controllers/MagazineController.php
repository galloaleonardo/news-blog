<?php

namespace App\Http\Controllers;

use App\Services\MagazineService;
use Illuminate\Http\Request;

class MagazineController extends Controller
{
    const INDEX_ROUTE = 'advertisements.index';
    const OBJECT_MESSAGE = 'admin.advertisings';

    public function __construct(private MagazineService $service) {}

    public function index()
    {
        $news = $this->service->index();

        $this->service->setSEOPages();

        return view(
            'magazine.homepage.index',
            [
                'categories' => $news['categories'],
                'advertising' => $news['advertising'],
                'featuredNews' => $news['featuredNews'],
                'recentNews' => $news['recentNews'],
                'featuredNewsCategories' => $news['featuredNewsCategories'],
                'popularNews' => $news['popularNews'],
                'topBanners' => $news['topBanners'],
                'topBannerSetting' => $news['topBannerSetting']
            ]
        );
    }

    public function show(int $id, string $title)
    {
        $news = $this->service->show($id);
    
        $this->service->setSEOPost($news['news']);

        return view('magazine.post.index', [
            'categories'=> $news['categories'],
            'news'=> $news['news'],
            'popularNews'=> $news['popularNews'],
            'suggestedNews'=> $news['suggestedNews'],
            'topBanners'=> $news['topBanners'],
            'topBannerSetting'=> $news['topBannerSetting'],
            'youtubeLinks' => $news['youtubeLinks'],
            'twitterLinks' => $news['twitterLinks'],
        ]);
    }

    public function all(Request $request)
    {
        $search   = $request->has('search') ? $request->get('search') : null;
        $category = $request->has('category') ? $request->get('category') : null;
        $author = $request->has('author') ? $request->get('author') : null;

        $news = $this->service->all($search, $category, $author);

        $this->service->setSEOPages();

        return view('magazine.all-news.index', [
            'news' => $news['news'],
            'categories' => $news['categories'],
            'topBanners' => $news['topBanners'],
            'topBannerSetting' => $news['topBannerSetting']
        ]);
    }
}

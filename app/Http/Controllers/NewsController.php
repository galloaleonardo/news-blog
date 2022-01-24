<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\NewsRequest;
use App\Models\Author;
use App\Models\News;
use App\Services\NewsService;
use Illuminate\Http\Request;

class NewsController extends CustomController
{
    const INDEX_ROUTE = 'news.index';
    const OBJECT_MESSAGE = 'admin.news';

    public function __construct(private NewsService $service) {}

    public function index()
    {
        $news = $this->service->index();
        $categories = Category::where('active', 1)->get();

        return view('admin.news.index-news', compact('news', 'categories'));
    }

    public function create()
    {
        $categories = Category::where('active', 1)->get();
        $authors = Author::where('active', 1)->get();

        return view('admin.news.create-news', compact('categories', 'authors'));
    }

    public function store(NewsRequest $request)
    {
        try {
            $data = $request->validated();

            $this->service->store($data);
        } catch (\Throwable $th) {
            return $this->responseRoute(
                $this::ERROR,
                $this::INDEX_ROUTE,
                $this::ERROR_CREATE_MESSAGE,
                $this::OBJECT_MESSAGE
            );
        }

        return $this->responseRoute(
            $this::SUCCESS,
            $this::INDEX_ROUTE,
            $this::SUCCESS_CREATE_MESSAGE,
            $this::OBJECT_MESSAGE
        );
    }

    public function edit(News $news)
    {
        $categories = Category::where('active', 1)->get();
        $authors = Author::where('active', 1)->get();

        return view('admin.news.edit-news', compact('news', 'categories', 'authors'));
    }

    public function update(NewsRequest $request, News $news)
    {
        try {
            $data = $request->validated();

            $this->service->update($news, $data);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return $this->responseRoute(
                $this::ERROR,
                $this::INDEX_ROUTE,
                $this::ERROR_UPDATE_MESSAGE,
                $this::OBJECT_MESSAGE
            );
        }

        return $this->responseRoute(
            $this::SUCCESS,
            $this::INDEX_ROUTE,
            $this::SUCCESS_UPDATE_MESSAGE,
            $this::OBJECT_MESSAGE
        );
    }

    public function destroy(News $news)
    {
        try {
            $this->service->destroy($news);
        } catch (\Throwable $th) {
            return $this->responseRoute(
                $this::ERROR,
                $this::INDEX_ROUTE,
                [$this::ERROR_DELETE_MESSAGE, $th->getMessage()],
                $this::OBJECT_MESSAGE
            );
        }
    
        return $this->responseRoute(
            $this::SUCCESS,
            $this::INDEX_ROUTE,
            $this::SUCCESS_DELETE_MESSAGE,
            $this::OBJECT_MESSAGE
        );
    }

    public function search(Request $request)
    {
        $news = $this->service->search($request);
        $categories = Category::where('active', 1)->get();

        return view('admin.news.index-news', compact('news', 'categories'));
    }
}

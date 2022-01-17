<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;

class NewsRepository
{
    public function __construct(private News $model) {}

    public function index()
    {
        return $this->model->orderBy('updated_at', 'desc')->paginate(10);
    }

    public function store(array $data)
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->model->findOrFail($id)->update($data);
    }

    public function destroy(int $id)
    {
        return $this->model->findOrFail($id)->delete();
    }

    public function search(Request $request)
    {
        $news = $this->model->query();

        if ($request->has('author')) {
            $news->join('authors', 'news.author_id', 'authors.id');
            $news->where('authors.name', 'LIKE', "%{$request->get('author')}%");
        }

        if ($request->has('title')) {
            $news->where('title', 'LIKE', "%{$request->get('title')}%");
        }

        if ($request->has('category_id')) {
            $news->where('category_id', $request->get('category_id'));
        }

        if ($request->has('display_order')) {
            $news->where('display_order', $request->get('display_order'));
        }

        if ($request->has('active')) {
            if ($request->get('active') == 'Y') {
                $news->where('news.active', true);
            } elseif ($request->get('active') == 'N') {
                $news->where('news.active', false);
            }
        }

        return $news->paginate(10)->appends($request->except('page'));
    }
}

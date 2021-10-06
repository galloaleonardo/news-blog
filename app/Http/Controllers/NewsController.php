<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Helpers\Helper;
use App\Models\Author;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;

class NewsController extends Controller
{

    public function index()
    {
        $news = News::orderBy('updated_at', 'desc')->paginate(10);
        $categories = Category::where('active', 1)->get();

        return view('admin.news.index-news', compact('news', 'categories'));
    }

    public function create()
    {
        $categories = Category::where('active', 1)->get();
        $authors = Author::where('active', 1)->get();

        return view('admin.news.create-news', compact('categories', 'authors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'max:100'],
            'subtitle' => ['required', 'max:255'],
            'image_link' => $this->validateImage(),
            'category_id' => ['required', 'numeric'],
            'author_id' => 'required',
            'content' => 'required'
        ]);

        $attributes = $request->all();

        $attributes['active'] = $request->has('active') ? true : false;
        $attributes['featured'] = $request->has('featured') ? true : false;
        $attributes['image_link'] = $this->uploadImageAndReturnName($request->file('image_link'));
        $attributes['content'] = str_replace('<p>', '<p class="mtb-40">', $attributes['content']);

        News::create($attributes);

        return redirect(route('news.index'))
            ->with('success', trans('admin.create_successfully', [
                'object' => trans('admin.news')
            ]));
    }

    public function edit(News $news)
    {
        $categories = Category::where('active', 1)->get();
        $authors = Author::where('active', 1)->get();

        return view('admin.news.edit-news', compact('news', 'categories', 'authors'));
    }

    public function update(Request $request, News $news)
    {
        $attributes = $request->all();

        $request->validate([
            'title' => ['required', 'max:100'],
            'subtitle' => ['required', 'max:255'],
            'category_id' => ['required', 'numeric'],
            'author_id' => 'required',
            'content' => 'required'
        ]);

        if ($request->hasFile('image_link')) {
            $request->validate(['image_link' => $this->validateImage()]);
            $attributes['image_link'] = $this->uploadImageAndReturnName($request->file('image_link'));
        }

        $attributes['active'] = $request->has('active') ? true : false;
        $attributes['featured'] = $request->has('featured') ? true : false;
        $attributes['content'] = str_replace('<p>', '<p class="mtb-40">', $attributes['content']);

        $news->update($attributes);

        return redirect(route('news.index'))
            ->with('success', trans('admin.updated_successfully', [
                'object' => trans('admin.news')
            ]));
    }

    public function destroy(News $news)
    {
        $news->delete();
        return redirect(route('news.index'))
            ->with('success', trans('admin.delete_successfully', [
                'object' => trans('admin.news')
            ]));
    }

    public function search(Request $request)
    {
        $news = News::query();
        $categories = Category::where('active', 1)->get();

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
                $news->where('active', true);
            } elseif ($request->get('active') == 'N') {
                $news->where('active', false);
            }
        }

        $news = $news->paginate(10)->appends($request->except('page'));

        return view('admin.news.index-news', compact('news', 'categories'));
    }

    private function uploadImageAndReturnName(UploadedFile $image)
    {
        $name = Helper::getRandomImageName();
        $jpg_name = "{$name}.jpg";
        $path_large = public_path('images/news/large/');
        $path_small = public_path('images/news/small/');

        Helper::checkPath([$path_large, $path_small]);

        Image::make($image)
            ->encode('jpg', 60)
            ->save($path_large . $jpg_name)
            ->resize(300, 300)
            ->save($path_small . $jpg_name);

        return $jpg_name;
    }

    private function validateImage()
    {
        $validate = [
            'required',
            'image',
            'mimes:jpeg,jpg,png',
            'max:800',
            'dimensions:max_width=1500, max_height=1500'
        ];

        return $validate;
    }
}

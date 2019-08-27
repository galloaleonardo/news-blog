<?php

namespace App\Http\Controllers;

use App\Category;
use App\Helpers\Helper;
use App\News;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;

class NewsController extends Controller {

    public function index()
    {
        $news       = News::paginate(10);
        $categories = Category::where('active', 1)->get();

        return view('admin.news.index-news', compact('news', 'categories'));
    }

    public function create()
    {
        $categories = Category::where('active', 1)->get();

        return view('admin.news.create-news', compact('categories'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'title'         => ['required', 'max:100'],
            'subtitle'      => ['required', 'max:255'],
            'image_link'    => $this->validateImage(),
            'category_id'   => ['required', 'numeric'],
            'display_order' => 'required',
            'author'        => 'required',
            'content'       => 'required'
        ]);

        $attributes = $request->all();

        $attributes['active']     = $request->has('active') ? true : false;
        $attributes['image_link'] = $this->uploadImageAndReturnName($request->file('image_link'));

        News::create($attributes);

        return redirect('/news')->with('success', 'News created successfuly.');
    }

    public function show(News $news)
    {
        return view('admin.news.show-news', compact('news'));
    }

    public function edit(News $news)
    {
        $categories = Category::where('active', 1)->get();
        return view('admin.news.edit-news', compact('news', 'categories'));
    }

    public function update(Request $request, News $news)
    {
        $attributes = $request->all();

        $request->validate([
            'title'         => ['required', 'max:100'],
            'subtitle'      => ['required', 'max:255'],
            'category_id'   => ['required', 'numeric'],
            'display_order' => 'required',
            'author'        => 'required',
            'content'       => 'required'
        ]);

        if ($request->hasFile('image_link')) {
            $request->validate(['image_link' => $this->validateImage()]);
            $attributes['image_link'] = $this->uploadImageAndReturnName($request->file('image_link'));
        }

        $attributes['active'] = $request->has('active') ? true : false;

        $news->update($attributes);

        return redirect('/news')->with('success', 'News updated successfuly.');
    }

    public function destroy(News $news)
    {
        $news->delete();
        return redirect('/news')->with('success', 'News deleted successfuly.');
    }

    public function search(Request $request)
    {
        $news       = News::query();
        $categories = Category::where('active', 1)->get();

        if ($request->has('title')) {
            $news->where('title', 'LIKE', "%{$request->get('title')}%");
        }

        if ($request->has('author')) {
            $news->where('author', 'LIKE', "%{$request->get('author')}%");
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
        $name       = Helper::getRandomNameImage();
        $jpg_name   = "{$name}.jpg";
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

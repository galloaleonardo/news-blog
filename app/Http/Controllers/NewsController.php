<?php

namespace App\Http\Controllers;

use App\Category;
use App\News;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;

class NewsController extends Controller {

    public function index()
    {
        $news = News::paginate(10);

        return view('admin.news.index-news', compact('news'));
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

        return redirect('/news');
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

        return redirect('/news');
    }

    public function destroy(News $news)
    {
        $news->delete();
        return redirect('/news');
    }

    private function uploadImageAndReturnName(UploadedFile $image)
    {
        $name = rand() . date('Y-m-d') . '.jpg';
        $path_large = public_path('images/news/large/') . $name;
        $path_small = public_path('images/news/small/') . $name;

        Image::make($image)
            ->encode('jpg', 60)
            ->save($path_large)
            ->resize('300', '300')
            ->save($path_small);

        return $name;
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

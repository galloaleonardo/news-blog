<?php

namespace App\Http\Controllers;

use App\Category;
use App\News;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

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
            'image_link'    => ['required', 'image', 'mimes:jpeg,jpg,png', 'max:1024'],
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
        //
    }

    public function edit(News $news)
    {
        //
    }

    public function update(Request $request, News $news)
    {
        //
    }

    public function destroy(News $news)
    {
        //
    }

    private function uploadImageAndReturnName(UploadedFile $image)
    {
        $image_name = rand() . date('Y-m-d') . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $image_name);

        return $image_name;
    }
}

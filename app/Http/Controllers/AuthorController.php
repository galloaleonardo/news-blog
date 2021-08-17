<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors = Author::paginate(10);

        return view('admin.authors.index-authors', compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.authors.create-authors');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $author = $request->all();

        $author['default'] = $request->has('default') ? true : false;
        $author['active'] = $request->has('active') ? true : false;

        Author::create($author);

        return redirect(route('authors.index'))
            ->with('success', trans('admin.created_successfully', [
                'object' => trans('admin.author')
            ]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        return view('admin.authors.show-authors', compact('author'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function edit(Author $author)
    {
        return view('admin.authors.edit-authors', compact('author'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Author $author)
    {
        \request()->validate([
            'name' => 'required'
        ]);

        $auxAuthor = \request()->all();

        $auxAuthor['default'] = \request()->has('default') ? true : false;
        $auxAuthor['active'] = \request()->has('active') ? true : false;

        $author->update($auxAuthor);

        return redirect(route('authors.index'))
            ->with('success', trans('admin.updated_successfully', [
                'object' => trans('admin.author')
            ]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        $author->delete();
        
        return redirect(route('authors.index'))
            ->with('success', trans('admin.deleted_successfully', [
                'object' => trans('admin.author')
            ]));
    }
}

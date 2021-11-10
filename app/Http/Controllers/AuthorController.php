<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\News;
use App\Services\AuthorService;
use Illuminate\Http\Request;

class AuthorController extends CustomController
{
    const INDEX_ROUTE = 'authors.index';
    const OBJECT_MESSAGE = 'admin.author';

    public function __construct(private AuthorService $service) {}

    public function index()
    {
        $authors = $this->service->index();

        return view('admin.authors.index-authors', compact('authors'));
    }

    public function create()
    {
        return view('admin.authors.create-authors');
    }

    public function store(Request $request)
    {
        try {
            $this->service->store($request);
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

    public function edit(Author $author)
    {
        return view('admin.authors.edit-authors', compact('author'));
    }

    public function update(Author $author)
    {
        try {
            $this->service->update($author);
        } catch (\Throwable $th) {
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

    public function destroy(Author $author)
    {
        try {
            $this->service->destroy($author);
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
}

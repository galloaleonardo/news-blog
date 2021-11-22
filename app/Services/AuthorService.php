<?php

namespace App\Services;

use App\Models\Author;
use App\Models\News;
use App\Repositories\AuthorRepository;
use Exception;

class AuthorService
{
    public function __construct(private AuthorRepository $repository) {}

    public function index()
    {
        return $this->repository->index();
    }

    public function store(array $data)
    {
        $data['default'] = isset($data['default']) ? true : false;
        $data['active'] = isset($data['active']) ? true : false;

        return $this->repository->store($data);
    }
    
    public function update(Author $author, array $data)
    {
        $data['default'] = isset($data['default']) ? true : false;
        $data['active'] = isset($data['active']) ? true : false;

        return $this->repository->update($author->id, $data);
    }

    public function destroy(Author $author)
    {
        $existsNewsWithThisAuthor = News::where('author_id', $author->id)->get()->count();

        throw_if($existsNewsWithThisAuthor, Exception::class, 'admin.error_fk_author');

        $this->repository->destroy($author->id);
    }
}

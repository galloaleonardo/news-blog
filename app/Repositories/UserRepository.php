<?php

namespace App\Repositories;

use App\Models\User;
use Auth;

class UserRepository
{
    const MAIN_USER = 1;

    public function __construct(private User $model) {}

    public function index()
    {
        return $this->model->where(function ($query) {
            $loggedInUserId = Auth::user()->id;

            if ($loggedInUserId !== self::MAIN_USER) {
                $query->where('id', $loggedInUserId);
            }
        })->paginate(10);
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
}

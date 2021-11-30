<?php

namespace App\Services;

use App\Mail\CreatedUser;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Str;
use Mail;

class UserService
{
    public function __construct(private UserRepository $repository) {}

     const MAIN_USER = 1;

    public function index()
    {
        return $this->repository->index();
    }

    public function store(array $data)
    {
        $password = Str::random();

        $data['password'] = \Hash::make($password);
        $data['first_password'] = $data['password'];
        $data['admin'] = isset($data['admin']) ? true : false;
        $data['active'] = isset($data['active']) ? true : false;

        $user = $this->repository->store($data);

        return Mail::queue(new CreatedUser($user, $password));
    }

    public function update(User $user, array $data)
    {
        $data['admin'] = isset($data['admin']) ? true : false;
        $data['active'] = isset($data['active']) ? true : false;

        return $this->repository->update($user->id, $data);
    }

    public function destroy(User $user)
    {
        return $this->repository->destroy($user->id);
    }
}

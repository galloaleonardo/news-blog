<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\UserService;
use Auth;

class UserController extends CustomController
{
    const MAIN_USER = 1;
    const INDEX_ROUTE = 'users.index';
    const OBJECT_MESSAGE = 'admin.user';
    const MAIN_USER_CANNOT_BE_DELETED_MESSAGE = 'admin.main_user_cant_delete';
    const USER_CANNOT_BE_DELETED_MESSAGE = 'admin.user_cant_delete';

    public function __construct(private UserService $service) {}

    public function index()
    {
        $users = $this->service->index();

        return view('admin.users.index-users', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create-users');
    }

    public function store(UserRequest $request)
    {
        try {
            $data = $request->validated();

            $this->service->store($data);
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

    public function edit(User $user)
    {
        return view('admin.users.edit-users', compact('user'));
    }

    public function update(UserRequest $request, User $user)
    {
        try {
            $data = $request->validated();

            $this->service->update($user, $data);
        } catch (\Throwable $th) {

            dd($th->getMessage());

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

    public function destroy(User $user)
    {
        if ($user->id === self::MAIN_USER) {
            return $this->responseRoute(
                $this::ERROR,
                $this::INDEX_ROUTE,
                $this::MAIN_USER_CANNOT_BE_DELETED_MESSAGE,
                $this::OBJECT_MESSAGE
            );
        }

        if ($user->id === Auth::user()->id) {
            return $this->responseRoute(
                $this::ERROR,
                $this::INDEX_ROUTE,
                $this::USER_CANNOT_BE_DELETED_MESSAGE,
                $this::OBJECT_MESSAGE
            );
        }

        try {
            $this->service->destroy($user);
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

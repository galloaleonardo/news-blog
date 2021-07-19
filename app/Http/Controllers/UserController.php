<?php

namespace App\Http\Controllers;

use App\Mail\CreatedUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserController extends Controller
{
    const MAIN_USER = 1;

    public function index()
    {
        $users = User::where(function ($query) {
            $userId = Auth::user()->id;

            if ($userId !== self::MAIN_USER) {
                $query->where('id', $userId);
            }
        })->paginate(15);

        return view('admin.users.index-users', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create-users');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email'
        ]);

        $attributes = $request->all();

        $password = Str::random();

        $attributes['password'] = \Hash::make($password);
        $attributes['active'] = $request->has('active') ? true : false;

        $user = User::create($attributes);

        Mail::queue(new CreatedUser($user, $password));

        return redirect(route('users.index'))
            ->with('success', trans('admin.user_created_successfully', [
                'object' => trans('admin.user'),
                'email' => $user->email
            ]));
    }

    public function show(User $user)
    {
        return view('admin.users.show-users', compact('user'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit-users', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $attributes = $request->all();

        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|unique:users,email, ' . $user->id
        ]);

        $attributes['admin'] = $request->has('admin') ? true : false;
        $attributes['active'] = $request->has('active') ? true : false;

        $user->update($attributes);

        return redirect(route('users.index'))
            ->with('success', trans('admin.updated_successfully', [
                'object' => trans('admin.user')
            ]));
    }

    public function destroy(User $user)
    {
        if ($user->id === self::MAIN_USER) {
            return redirect(route('users.index'))->with('warning', trans('admin.main_user_cant_delete'));
        }

        if ($user->id === Auth::user()->id) {
            return redirect(route('users.index'))->with('warning', trans('admin.user_cant_delete'));
        }

        $user->delete();

        return redirect(route('users.index'))
            ->with('success', trans('admin.updated_successfully', [
                'object' => trans('admin.user')
            ]));;
    }

    public function changePasswordShow(User $user)
    {
        return view('admin.users.change-password-users', compact('user'));
    }

    public function changePassword(Request $request, User $user)
    {
        $attributes = $request->all();

        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|max:16|confirmed',
        ]);

        if (!\Hash::check($attributes['current_password'], $user->password)) {
            return redirect(route('users.change-password.show', compact('user')))->with('warning', 'The current password does not match.');
        }

        $user->update(['password' => \Hash::make($attributes['new_password'])]);

        return $this->index();
    }
}

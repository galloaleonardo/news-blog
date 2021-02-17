<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Mail\CreatedUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    const MAIN_USER = 1;

    public function index()
    {
        $users = User::paginate(15);

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
            'email' => 'required|unique:users,email'
        ]);

        $attributes = $request->all();

        $password = env('APP_NAME') . rand();

        $attributes['password'] = \Hash::make($password);
        $attributes['active']   = $request->has('active') ? true : false;

        $user = User::create($attributes);

        Mail::queue(new CreatedUser($user, $password));

        return redirect(route('users.index'))->with('success', 'User created successfuly.');
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

        $attributes['admin']   = $request->has('admin') ? true : false;
        $attributes['active']  = $request->has('active') ? true : false;

        $user->update($attributes);

        return redirect(route('users.index'))->with('success', 'User updated successfuly.');
    }

    public function destroy(User $user)
    {
        if ($user->id === self::MAIN_USER) {
            return redirect(route('users.index'))->with('warning', 'Main user cannot be deleted.');
        }

        $user->delete();

        return redirect(route('users.index'))->with('success', 'User deleted successfuly.');
    }
}

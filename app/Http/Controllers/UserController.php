<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
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
            'email' => 'required'
        ]);

        $attributes = $request->all();

        if ($request->hasFile('avatar')) {
            $request->validate(['avatar' => $this->validateImage()]);
            $attributes['avatar'] = $this->uploadImageAndReturnName($request->file('avatar'));
        }

        $attributes['password'] = \Hash::make('1234567890');
        $attributes['admin']    = $request->has('admin') ? true : false;
        $attributes['active']   = $request->has('active') ? true : false;
        $attributes['token']    = \Str::random(50);

        User::create($attributes);

        return redirect('/users')->with('success', 'User created successfuly.');
    }

    public function show(User $user)
    {
        return view('admin.users.show-users', compact('user'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit-users', compact('user'));
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect('/users')->with('success', 'User deleted successfuly.');
    }

    private function uploadImageAndReturnName(UploadedFile $image)
    {
        $name       = Helper::getRandomNameImage();
        $jpg_name   = "{$name}.jpg";
        $path_large = public_path('images/avatars/');

        Helper::checkPath([$path_large]);

        Image::make($image)
            ->encode('jpg', 60)
            ->save($path_large . $jpg_name);

        return $jpg_name;
    }

    private function validateImage()
    {
        $validate = [
            'image',
            'mimes:jpeg,jpg,png',
            'max:800',
            'dimensions:max_width=600, max_height=600'
        ];

        return $validate;
    }
}

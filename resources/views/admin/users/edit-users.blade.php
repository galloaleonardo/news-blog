@extends('admin.layouts.admin-layout')

@section('title-page')
    News Blog - Users
@endsection

@section('title-content')
    User
@endsection

@section('content')
    @include('admin.errors')

    <div class="card shadow mb-4">
        <div class="card-header py-3"><i class="fas fa-edit"></i> Update user</div>
        <div class="card-body">
            <form method="POST" action="/categories/{{ $user->id }}">
                @method('PATCH')
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name">Name</label>
                        <input type="text" class="form-control {{ $errors->has('name') ? 'border-left-danger' : '' }}" id="name" name="name" value="{{ $user->name }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="name">Email</label>
                        <input type="email" class="form-control {{ $errors->has('email') ? 'border-left-danger' : '' }}" id="email" name="email" value="{{ $user->email }}">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="image_link">Avatar image - <small>(Max. 600px x 600px) - (Max. 800kb)</small></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-images"></i>
                                </span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="avatar" name="avatar">
                                <label class="custom-file-label {{ $errors->has('avatar') ? 'border-left-danger' : '' }}" for="avatar">{{ $user->avatar }}</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="admin" name="admin" {{ $user->admin ? 'checked' : '' }}>
                        <label class="form-check-label" for="admin">
                            Admin
                            <i class="far fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="Admin user has full system permission, including all users."></i>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="active" name="active" {{ $user->active ? 'checked' : '' }}>
                        <label class="form-check-label" for="active">
                            Active
                        </label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
@endsection

@extends('admin.layouts.admin-layout')

@section('title-page')
    News Blog - Users
@endsection

@section('title-content')
    Users
@endsection

@section('content')
    @include('admin.errors')

    <div class="card shadow mb-4">
        <div class="card-header py-3"><i class="fas fa-plus-square"></i> Create a new user</div>
        <div class="card-body">
            <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name">Name</label>
                        <input type="text" class="form-control {{ $errors->has('name') ? 'border-left-danger' : '' }}" id="name" name="name" value="{{ old('name') }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="name">Email</label>
                        <input type="email" class="form-control {{ $errors->has('email') ? 'border-left-danger' : '' }}" id="email" name="email" value="{{ old('email') }}">
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
                            <label class="custom-file-label {{ $errors->has('avatar') ? 'border-left-danger' : '' }}" for="avatar">Choose image...</label>
                        </div>
                    </div>
                </div>
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <label class="form-check-label" for="admin">
                        <input class="form-check-input" type="checkbox" id="admin" name="admin" {{ old('admin') ? 'checked' : '' }}>
                            Admin
                            <i class="far fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="Admin user has full system permission, including all users."></i>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <label class="form-check-label" for="active">
                        <input class="form-check-input" type="checkbox" id="active" name="active" checked>
                            Active
                        </label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
@endsection

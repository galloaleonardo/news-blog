@extends('admin.layouts.admin-layout')

@section('title-page')
    {{ App\Helpers\Helper::getCompanyName() }} - Users
@endsection

@section('title-content')
    User
@endsection

@section('content')
    @include('admin.errors')
    {{ Breadcrumbs::render('users-show-edit', $user) }}
    <div class="card shadow mb-4">
        <div class="card-header py-3"><i class="fas fa-edit"></i> Change user password</div>
        <div class="card-body">
            <form method="POST" action="{{ route('users.change-password.update', $user->id) }}" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="current_password">Current Password</label>
                        <input type="password" maxlength="16" class="form-control {{ $errors->has('current_password') ? 'border-left-danger' : '' }}" id="current_password" name="current_password">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="new_password">New Password</label>
                        <input type="password" maxlength="16" class="form-control {{ $errors->has('new_password') ? 'border-left-danger' : '' }}" id="new_password" name="new_password">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="new_password_confirmation">Confirm New Password</label>
                        <input type="password" maxlength="16" class="form-control {{ $errors->has('new_password_confirmation') ? 'border-left-danger' : '' }}" id="new_password_confirmation" name="new_password_confirmation">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection

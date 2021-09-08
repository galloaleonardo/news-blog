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
        <div class="card-header py-3"><i class="fas fa-edit"></i> {{ trans('admin.update') }} {{ trans('admin.user') }}</div>
        <div class="card-body">
            <form method="POST" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="name">{{ trans('admin.name') }}</label>
                        <input type="text" class="form-control {{ $errors->has('name') ? 'border-left-danger' : '' }}" id="name" name="name" value="{{ $user->name }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="name">{{ trans('admin.email') }}</label>
                        <input type="email" class="form-control {{ $errors->has('email') ? 'border-left-danger' : '' }}" id="email" name="email" value="{{ $user->email }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="email_confirmation">{{ trans('admin.email_confirmation') }}</label>
                        <input type="email" class="form-control {{ $errors->has('email_confirmation') ? 'border-left-danger' : '' }}" id="email_confirmation" name="email_confirmation" value="{{ $user->email_confirmation }}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="active" name="active" {{ $user->active ? 'checked' : '' }}>
                        <label class="form-check-label" for="active">
                            {{ trans('admin.active') }}
                        </label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">{{ trans('admin.update') }}</button>
            </form>
        </div>
    </div>
@endsection

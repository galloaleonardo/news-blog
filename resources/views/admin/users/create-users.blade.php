@extends('admin.layouts.admin-layout')

@section('title-page')
    {{ App\Helpers\Helper::getCompanyName() }} - Users
@endsection

@section('title-content')
    Users
@endsection

@section('content')
    @include('admin.errors')
    {{ Breadcrumbs::render('users-create') }}
    <div class="card shadow mb-4">
        <div class="card-header py-3"><i class="fas fa-plus-square"></i> {{ trans('admin.create') }} {{ trans('admin.user') }}</div>
        <div class="card-body">
            <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="name">{{ trans('admin.name') }}</label>
                        <input type="text" class="form-control {{ $errors->has('name') ? 'border-left-danger' : '' }}" id="name" name="name" value="{{ old('name') }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="email">{{ trans('admin.email') }}</label>
                        <input type="email" class="form-control {{ $errors->has('email') ? 'border-left-danger' : '' }}" id="email" name="email" value="{{ old('email') }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="email_confirmation">{{ trans('admin.email_confirmation') }}</label>
                        <input type="email" class="form-control {{ $errors->has('email_confirmation') ? 'border-left-danger' : '' }}" id="email_confirmation" name="email_confirmation" value="{{ old('email_confirmation') }}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <label class="form-check-label" for="active">
                        <input class="form-check-input" type="checkbox" id="active" name="active" checked>
                            {{ trans('admin.active') }}
                        </label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">{{ trans('admin.create') }}</button>
            </form>
        </div>
    </div>
@endsection

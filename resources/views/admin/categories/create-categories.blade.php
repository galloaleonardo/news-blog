@extends('admin.layouts.admin-layout')

@section('title-page')
    News Blog - {{ trans('admin.categories') }}
@endsection

@section('title-content')
    {{ trans('admin.category') }}
@endsection

@section('content')
    @include('admin.errors')
    {{ Breadcrumbs::render('category-create') }}
    <div class="card shadow mb-4">
        <div class="card-header py-3"><i class="fas fa-plus-square"></i> {{ trans('admin.create_new') }} {{ trans('admin.category') }}</div>
        <div class="card-body">
            <form method="POST" action="{{ route('categories.store') }}">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name">{{ trans('admin.name') }} </label>
                        <input type="text" class="form-control {{ $errors->has('name') ? 'border-left-danger' : '' }}" id="name" name="name" value="{{ old('name') }}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="displays_in_menu" name="displays_in_menu" value="{{ old('displays_in_menu') }}">
                        <label class="form-check-label" for="displays_in_menu">
                            {{ trans('admin.displays_menu') }}
                        </label>
                        <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('admin.displays_menu_description') }}"></i>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="featured" name="featured" value="{{ old('featured') }}">
                        <label class="form-check-label" for="featured">
                            {{ trans('admin.featured') }}
                        </label>
                        <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('admin.news') }}"></i>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="active" name="active" checked>
                        <label class="form-check-label" for="active">
                            {{ trans('admin.active') }}
                        </label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">{{ trans('admin.create') }}</button>
            </form>
        </div>
    </div>
@endsection

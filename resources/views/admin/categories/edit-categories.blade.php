@extends('admin.layouts.admin-layout')

@section('title-page')
    {{ App\Helpers\Helper::getCompanyName() }} - {{ trans('admin.categories') }}
@endsection

@section('title-content')
    {{ trans('admin.category') }}
@endsection

@section('content')
    @include('admin.errors')
    {{ Breadcrumbs::render('category-show-edit', $category) }}
    <div class="card shadow mb-4">
        <div class="card-header py-3"><i class="fas fa-edit"></i> {{ trans('admin.update') }} {{ trans('admin.category') }}</div>
        <div class="card-body">
            <form method="POST" action="{{ route('categories.update', $category->id) }}">
                @method('PATCH')
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name">{{ trans('admin.name') }}</label>
                        <input type="text" class="form-control {{ $errors->has('name') ? 'border-left-danger' : '' }}" id="name" name="name" value="{{ $category->name }}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="displays_in_menu" name="displays_in_menu" {{ $category->displays_in_menu ? 'checked' : '' }}>
                        <label class="form-check-label" for="displays_in_menu">
                            {{ trans('admin.displays_menu') }}
                        </label>
                        <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('admin.displays_menu_description') }}"></i>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="featured" name="featured" {{ $category->featured ? 'checked' : '' }}>
                        <label class="form-check-label" for="featured">
                            {{ trans('admin.featured') }}
                        </label>
                        <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('admin.featured_category_description') }}"></i>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="active" name="active" {{ $category->active ? 'checked' : '' }}>
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

@extends('admin.layouts.admin-layout')

@section('title-page')
    {{ App\Helpers\Helper::getCompanyName() }} - {{ trans('admin.authors') }}
@endsection

@section('title-content')
    {{ trans('admin.authors') }}
@endsection

@section('content')
    @include('admin.errors')
    {{ Breadcrumbs::render('author-create') }}
    <div class="card shadow mb-4">
        <div class="card-header py-3"><i class="fas fa-plus-square"></i> {{ trans('admin.create_new') }} {{ trans('admin.author') }}</div>
        <div class="card-body">
            <form method="POST" action="{{ route('authors.store') }}">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name">{{ trans('admin.name') }} </label>
                        <input type="text" class="form-control {{ $errors->has('name') ? 'border-left-danger' : '' }}" id="name" name="name" value="{{ old('name') }}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="default" name="default" value="{{ old('default') }}">
                        <label class="form-check-label" for="default">
                            {{ trans('admin.default') }}
                        </label>
                        <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('admin.default') }}"></i>
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

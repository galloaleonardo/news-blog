@extends('admin.layouts.admin-layout')

@section('title-page')
    {{ App\Helpers\Helper::getCompanyName() }} - {{ trans('admin.seo') }}
@endsection

@section('title-content')
    {{ trans('SEO') }}
@endsection

@section('content')
    @include('admin.errors')
    {{ Breadcrumbs::render('seo-edit') }}
    <div class="card shadow mb-4">
        <div class="card-header py-3"><i
                class="fas fa-edit"></i> {{ trans('admin.update') }} {{ trans('admin.settings') }}</div>
        <div class="card-body">
            <form method="POST" action="{{ route('seo.update', $seo->id) }}" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="page_title">{{ trans('admin.page_title') }}</label>
                        <input type="text"
                               class="form-control {{ $errors->has('page_title') ? 'border-left-danger' : '' }}"
                               id="page_title" name="page_title" value="{{ $seo->page_title }}">
                    </div>
                    <div class="form-group col-md-8">
                        <label for="page_description">{{ trans('admin.page_description') }}</label>
                        <input type="text"
                               class="form-control {{ $errors->has('page_description') ? 'border-left-danger' : '' }}"
                               id="page_description" name="page_description" value="{{ $seo->page_description }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="page_type">{{ trans('admin.page_type') }}</label>
                        <input type="text"
                               class="form-control {{ $errors->has('page_description') ? 'border-left-danger' : '' }}"
                               id="page_type" name="page_type" value="{{ $seo->page_type }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="twitter_user">{{ trans('admin.twitter_user') }}</label>
                        <input type="text"
                               class="form-control {{ $errors->has('page_description') ? 'border-left-danger' : '' }}"
                               id="twitter_user" name="twitter_user" value="{{ $seo->twitter_user }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="image_link">{{ trans('admin.image_link') }} - <small>(Max. 1mb)</small></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-images"></i>
                                </span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image_link"
                                       name="image_link">
                                <label
                                    class="custom-file-label {{ $errors->has('image_link') ? 'border-left-danger' : '' }}"
                                    for="image_link">{{ $seo->image_link }}</label>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">{{ trans('admin.update') }}</button>
            </form>
        </div>
    </div>
@endsection

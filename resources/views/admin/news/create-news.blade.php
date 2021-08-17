@extends('admin.layouts.admin-layout')

@section('title-page')
    {{ App\Helpers\Helper::getCompanyName() }} - {{ trans('admin.news') }}
@endsection

@section('title-content')
    {{ trans('admin.news') }}
@endsection

@section('content')
    @include('admin.errors')
    {{ Breadcrumbs::render('news-create') }}
    <div class="card shadow mb-4">
        <div class="card-header py-3"><i
                class="fas fa-plus-square"></i> {{ trans('admin.create_new') }} {{ trans('admin.news') }}</div>
        <div class="card-body">
            <form method="POST" action="{{ route('news.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name">{{ trans('admin.title') }}</label>
                        <input type="text" class="form-control {{ $errors->has('title') ? 'border-left-danger' : '' }}"
                               id="title" name="title" value="{{ old('title') }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="image_link">{{ trans('admin.main_image') }} - <small>(Max. 1500px x 1500px) - (Max.
                                800kb)</small></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-images"></i>
                                </span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image_link" name="image_link">
                                <label
                                    class="custom-file-label {{ $errors->has('image_link') ? 'border-left-danger' : '' }}"
                                    for="image_link">Choose image...</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="subtitle">{{ trans('admin.subtitle') }}</label>
                    <textarea class="form-control {{ $errors->has('subtitle') ? 'border-left-danger' : '' }}"
                              name="subtitle" id="subtitle">{{ old('subtitle') }}</textarea>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="category_id">{{ trans('admin.category') }}</label>
                        <select id="category_id" name="category_id"
                                class="form-control {{ $errors->has('category_id') ? 'border-left-danger' : '' }}">
                            <option selected disabled>{{ trans('admin.choose') }}</option>
                            @foreach($categories as $category)
                                <option
                                    value="{{ $category->id }}" {{ $category->id == old('category_id') ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="author_id">{{ trans('admin.author') }}</label>
                        <select id="author_id" name="author_id"
                                class="form-control {{ $errors->has('author_id') ? 'border-left-danger' : '' }}">
                            <option selected disabled>{{ trans('admin.choose') }}</option>
                            @foreach($authors as $author)
                                <option
                                    value="{{ $author->id }}" {{ (old('author_id') ? $author->id == old('author_id') : $author->default) ? 'selected' : '' }}>{{ $author->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="youtube_links">{{ trans('admin.youtube_links') }}</label>
                        <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('admin.youtube_links_info') }}"></i>
                        <textarea class="form-control {{ $errors->has('youtube_links') ? 'border-left-danger' : '' }}"
                                name="youtube_links" id="youtube_links">{{ old('youtube_links') }}</textarea>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label class="{{ $errors->has('content') ? 'border-bottom-danger' : '' }}"
                               for="news_content">{{ trans('admin.content') }}</label>
                        <textarea name="content" id="news_content">{{ old('content') }} </textarea>
                        <script>
                            CKEDITOR.replace('news_content');
                        </script>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="featured" name="featured">
                        <label class="form-check-label" for="featured">
                            {{ trans('admin.featured') }}
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="active" name="active" checked>
                        <label class="form-check-label" for="active">
                            {{ trans('admin.active') }}
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary mt-4">{{ trans('admin.create') }}</button>
            </form>
        </div>
    </div>
@endsection

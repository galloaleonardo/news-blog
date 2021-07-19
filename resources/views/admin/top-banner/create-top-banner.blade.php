@extends('admin.layouts.admin-layout')

@section('title-page')
    {{ App\Helpers\Helper::getCompanyName() }} - {{ trans('admin.adverts') }}
@endsection

@section('title-content')
    {{ trans('admin.top_banner') }}
@endsection

@section('content')
    @include('admin.errors')
    {{ Breadcrumbs::render('top-banner-create') }}
    <div class="card shadow mb-4">
        <div class="card-header py-3"><i class="fas fa-plus-square"></i> {{ trans('admin.create') }} {{ trans('admin.top_banner') }}</div>
        <div class="card-body">
            <form method="POST" action="{{ route('top-banner.store') }}"  enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="name">{{ trans('admin.title') }}</label>
                        <input type="text" class="form-control {{ $errors->has('title') ? 'border-left-danger' : '' }}" id="title" name="title" value="{{ old('title') }}">
                    </div>

                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="image_link">{{ trans('admin.image') }} - <small>({{ trans('admin.suggested') }} 1500px x 200px) - (Max. 800kb)</small></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-images"></i>
                                </span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image_link" name="image_link">
                                <label class="custom-file-label {{ $errors->has('image_link') ? 'border-left-danger' : '' }}" for="image_link">Choose image...</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="name">{{ trans('admin.destination_link') }}</label>
                        <input type="text" class="form-control {{ $errors->has('destination_link') ? 'border-left-danger' : '' }}" id="destination_link" name="destination_link" value="{{ old('destination_link') }}">
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

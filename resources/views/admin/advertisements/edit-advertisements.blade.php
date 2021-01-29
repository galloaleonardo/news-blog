@extends('admin.layouts.admin-layout')

@section('title-page')
    News Blog - {{ trans('admin.adverts') }}

@endsection

@section('title-content')
    {{ trans('admin.adverts') }}
@endsection

@section('content')
    @include('admin.errors')
    {{ Breadcrumbs::render('advertisements-show-edit', $advertising) }}
    <div class="card shadow mb-4">
        <div class="card-header py-3"><i class="fas fa-edit"></i> {{ trans('admin.update') }} {{ trans('admin.adverts') }}</div>
        <div class="card-body">
            <form method="POST" action="{{ route('advertisements.update', $advertising->id) }}" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="name">Tile</label>
                        <input type="text" class="form-control {{ $errors->has('title') ? 'border-left-danger' : '' }}" id="title" name="title" value="{{ $advertising->title }}">
                    </div>

                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="image_link">{{ trans('admin.image') }} - <small>(Max. 600px x 600px) - (Max. 800kb)</small></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-images"></i>
                                </span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image_link" name="image_link">
                                <label class="custom-file-label {{ $errors->has('image_link') ? 'border-left-danger' : '' }}" for="image_link">{{ $advertising->image_link }}</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="name">{{ trans('admin.destination_link') }}</label>
                        <input type="text" class="form-control {{ $errors->has('destination_link') ? 'border-left-danger' : '' }}" id="destination_link" name="destination_link" value="{{ $advertising->destination_link }}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="active" name="active" value="{{ $advertising->active }}" checked>
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

@extends('admin.layouts.admin-layout')

@section('title-page')
    {{ App\Helpers\Helper::getCompanyName() }} - {{ trans('admin.settings') }}
@endsection

@section('title-content')
    Settings
@endsection

@section('content')
    @include('admin.errors')
    {{ Breadcrumbs::render('settings-edit') }}
    <div class="card shadow mb-4">
        <div class="card-header py-3"><i class="fas fa-edit"></i> {{ trans('admin.update') }} {{ trans('admin.settings') }}</div>
        <div class="card-body">
            <form method="POST" action="{{ route('settings.update', $settings->id) }}" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="company_name">{{ trans('admin.company_name') }}</label>
                        <input type="text"
                               class="form-control {{ $errors->has('company_name') ? 'border-left-danger' : '' }}"
                               id="company_name" name="company_name" value="{{ $settings->company_name }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="language_id">{{ trans('admin.language') }}</label>
                        <select id="language_id" name="language_id"
                                class="form-control {{ $errors->has('language_id') ? 'border-left-danger' : '' }}">
                            <option selected disabled>Choose...</option>
                            @foreach($languages as $language)
                                <option
                                    value="{{ $language->id }}" {{ $language->id == $settings->language_id ? 'selected' : '' }}>{{ $language->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="company_logo_link">{{ trans('admin.company_logo') }}</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-images"></i>
                                </span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="company_logo_link"
                                       name="company_logo_link">
                                <label
                                    class="custom-file-label {{ $errors->has('company_logo_link') ? 'border-left-danger' : '' }}"
                                    for="company_logo_link">{{ $settings->company_logo_link }}</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="icon_tab_link">{{ trans('admin.icon_tab') }}</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-images"></i>
                                </span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="icon_tab_link"
                                       name="icon_tab_link">
                                <label
                                    class="custom-file-label {{ $errors->has('icon_tab_link') ? 'border-left-danger' : '' }}"
                                    for="icon_tab_link">{{ $settings->icon_tab_link }}</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="use_logo_by_default" name="use_logo_by_default" {{ $settings->use_logo_by_default ? 'checked' : '' }}>
                            <label class="form-check-label" for="use_logo_by_default">
                                {{ trans('admin.use_logo_by_default') }}
                            </label>
                            <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('admin.use_logo_by_default_description') }}"></i>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">{{ trans('admin.update') }}</button>
            </form>
        </div>
    </div>
@endsection

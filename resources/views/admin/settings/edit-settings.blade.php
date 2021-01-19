@extends('admin.layouts.admin-layout')

@section('title-page')
    Larazine - Settings
@endsection

@section('title-content')
    Settings
@endsection

@section('content')
    @include('admin.errors')
    {{ Breadcrumbs::render('settings-edit') }}
    <div class="card shadow mb-4">
        <div class="card-header py-3"><i class="fas fa-edit"></i> Update settings</div>
        <div class="card-body">
            <form method="POST" action="{{ route('settings.update', $settings->id) }}">
                @method('PATCH')
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="company_name">Company name</label>
                        <input type="text"
                               class="form-control {{ $errors->has('company_name') ? 'border-left-danger' : '' }}"
                               id="company_name" name="company_name" value="{{ $settings->company_name }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="image_link">Company logo</label>
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
                        <label for="language_id">Language</label>
                        <select id="language_id" name="language_id"
                                class="form-control {{ $errors->has('language_id') ? 'border-left-danger' : '' }}">
                            <option selected disabled>Choose...</option>
                            @foreach($languages as $language)
                                <option
                                    value="{{ $language->id }}" {{ $language->id == $settings->language_id ? 'selected' : '' }}>{{ $language->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection

@extends('admin.layouts.admin-layout')

@section('title-page')
    {{ App\Helpers\Helper::getCompanyName() }} - {{ trans('admin.google_analytics') }}
@endsection

@section('title-content')
    {{ trans('admin.google_analytics') }}
@endsection

@section('content')
    @include('admin.errors')
    {{ Breadcrumbs::render('google-analytics-edit') }}
    <div class="card shadow mb-4">
        <div class="card-header py-3"><i class="fas fa-edit"></i> {{ trans('admin.update') }} {{ trans('admin.google_analytics') }}</div>
        <div class="card-body">
            <form method="POST" action="{{ route('google-analytics.update', $googleAnalytics->id) }}" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="script">{{ trans('admin.script') }}</label>
                        <textarea class="form-control" id="script" name="script" rows="4">{{ $googleAnalytics->script }}</textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="active" name="active" {{ $googleAnalytics->active ? 'checked' : '' }}>
                            <label class="form-check-label" for="active">
                                {{ trans('admin.active') }}
                            </label>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">{{ trans('admin.update') }}</button>
            </form>
        </div>
    </div>
@endsection

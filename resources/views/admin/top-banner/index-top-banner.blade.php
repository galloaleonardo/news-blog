@extends('admin.layouts.admin-layout')

@section('title-page')
    {{ App\Helpers\Helper::getCompanyName() }} - {{ trans('admin.top_banner') }}
@endsection

@section('title-content')
    {{ trans('admin.top_banner') }}
@endsection


@section('content')
    @include('admin.errors')
    {{ Breadcrumbs::render('top-banner') }}
    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="POST" action="{{ route('top-banner-setting.update', $topBannerSetting->id) }}">
                @method('PATCH')
                @csrf
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="active" name="active" {{ $topBannerSetting->active ? 'checked' : '' }}>
                        <label class="form-check-label" for="active">
                            {{ trans('admin.active') }}
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="keep_on_top_when_scrolling" name="keep_on_top_when_scrolling" {{ $topBannerSetting->keep_on_top_when_scrolling ? 'checked' : '' }}>
                        <label class="form-check-label" for="keep_on_top_when_scrolling">
                            {{ trans('admin.keep_on_top_when_scrolling') }}
                        </label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">{{ trans('admin.edit') }}</button>
            </form>
        </div>
    </div>


    @include('admin.modal-delete-index')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{ route('top-banner.create') }}" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-plus-square"></i>
                    </span>
                <span class="text">{{ trans('admin.create_new') }}</span>
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                <thead>
                                <tr role="row">
                                    <th>{{ trans('admin.title') }}</th>
                                    <th>{{ trans('admin.destination_link') }}</th>
                                    <th class="min text-center">{{ trans('admin.active') }}</th>
                                    <th class="min text-center">{{ trans('admin.action') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($topBanners as $topBanner)
                                    <tr role="row">
                                        <td>{{ $topBanner->title }}</td>
                                        <td>{{ $topBanner->destination_link }} </td>
                                        <td class="min text-center">
                                            <input type="checkbox" style="width:20px; height: 20px" id="is-active" disabled {{ $topBanner->active ? 'checked="checked"' : '' }}>
                                            <label class="form-check-label" for="is-active"></label>
                                        </td>
                                        <td class="min text-center">
                                            <a href="{{ route('top-banner.edit', $topBanner->id) }}" class="btn btn-light btn-sm">
                                                <span class="icon text-info" data-toggle="tooltip" data-placement="top" title="Edit">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </span>
                                            </a>

                                            <a href="javascript:" data-toggle="modal" data-target="#modalDelete" class="btn btn-light btn-sm" onclick="deleteData('top-banner', {{$topBanner->id}})">
                                                <span class="icon text-danger" data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i class="fas fa-trash-alt"></i>
                                                </span>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-7">
                            {{ $topBanners->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

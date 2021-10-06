@extends('admin.layouts.admin-layout')

@section('title-page')
    {{ App\Helpers\Helper::getCompanyName() }} - Dashboard
@endsection

@section('title-content')
    Dashboard
@endsection
@if(App\Helpers\Helper::userIsAdmin())
    @section('content')
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{ trans('admin.active_news') }}</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $dashboard['news'] }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-newspaper fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">{{ trans('admin.categories') }}</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $dashboard['categories']  }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-sitemap fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">{{ trans('admin.active_advertisements') }}</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $dashboard['advertisements'] }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fab fa-adversal fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-dark shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">{{ trans('admin.users') }}</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $dashboard['users'] }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Content Column -->
            <div class="col-lg-12 mb-4">
                <!-- Project Card Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{ trans('admin.number_of_news_views') }}</h6>
                    </div>
                    <div class="card-body">
                        {!! $lineChart->container() !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Content Column -->
            <div class="col-lg-12 mb-4">
                <!-- Project Card Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{ trans('admin.news_with_the_most_views') }}</h6>
                    </div>
                    <div class="card-body">
                        {!! $barChart->container() !!}
                    </div>
                </div>
            </div>
        </div>
    @endsection
@endif

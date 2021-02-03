@extends('admin.layouts.admin-layout')

@section('title-page')
    {{ App\Helpers\Helper::getCompanyName() }} - {{ trans('admin.news') }}
@endsection

@section('title-content')
    {{ trans('admin.news') }}
@endsection

@section('content')
    @include('admin.modal-delete-index')
    {{ Breadcrumbs::render('news') }}
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{ route('news.create') }}" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-plus-square"></i>
                    </span>
                <span class="text">{{ trans('admin.create_new') }}</span>
            </a>
        </div>
        <div class="card-body">
            <div id="accordion">
                <div class="card mb-4">
                    <div class="card-header py-3" id="headingOne">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFilter" aria-expanded="false" aria-controls="collapseFilter">
                                <i class="fas fa-filter"></i> {{ trans('admin.filter') }}
                            </button>
                        </h5>
                    </div>

                    <div id="collapseFilter" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                            <form method="GET" action="{{ route('news.search') }}">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <input type="text" class="form-control" id="title" name="title" placeholder="{{ trans('admin.title') }}">
                                    </div>

                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <select id="category_id" name="category_id" class="form-control">
                                            <option selected disabled>{{ trans('admin.category') }}</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <select id="active" name="active" class="form-control">
                                            <option selected disabled>{{ trans('admin.active') }}</option>
                                            <option value="A">{{ trans('admin.all') }}</option>
                                            <option value="Y">{{ trans('admin.yes') }}</option>
                                            <option value="N">{{ trans('admin.no') }}</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type="text" class="form-control" id="author" name="author" placeholder="{{ trans('admin.author') }}">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                                <a href="{{ route('news.index') }}" class="btn btn-warning btn-icon-split">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-broom"></i>
                                    </span>
                                    <span class="text">{{ trans('admin.clear_filter') }}</span>
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                <thead>
                                <tr role="row">
                                    <th>{{ trans('admin.title') }}</th>
                                    <th class="min">{{ trans('admin.category') }}</th>
                                    <th class="min">{{ trans('admin.featured') }}</th>
                                    <th class="min">{{ trans('admin.author') }}</th>
                                    <th class="min text-center">{{ trans('admin.action') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($news as $new)
                                    <tr role="row">
                                        <td>{{ $new->title }}</td>
                                        <td class="min">{{ $new->category->name }}</td>
                                        <td class="min text-center">
                                            <input type="checkbox" style="width:20px; height: 20px" id="fatured" disabled {{ $new->featured ? 'checked="checked"' : '' }}>
                                            <label class="form-check-label" for="fatured"></label>
                                        <td class="min">{{ $new->author }}</td>
                                        <td class="min text-center">
                                            <a href="{{ route('news.show', $new->id) }}" class="btn btn-light btn-sm">
                                                <span class="icon text-black" data-toggle="tooltip" data-placement="top" title="View">
                                                    <i class="fas fa-eye"></i>
                                                </span>
                                            </a>

                                            <a href="{{ route('news.edit', $new->id) }}" class="btn btn-light btn-sm">
                                                <span class="icon text-info" data-toggle="tooltip" data-placement="top" title="Edit">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </span>
                                            </a>

                                            <a href="javascript:" data-toggle="modal" data-target="#modalDelete" class="btn btn-light btn-sm" onclick="deleteData('news', {{$new->id}})">
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
                            {{ $news->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

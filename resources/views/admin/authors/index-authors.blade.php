@extends('admin.layouts.admin-layout')

@section('title-page')
    {{ App\Helpers\Helper::getCompanyName() }} - {{ trans('admin.authors') }}
@endsection

@section('title-content')
    {{ trans('admin.authors') }}
@endsection

@section('content')
    @include('admin.modal-delete-index')
    {{ Breadcrumbs::render('authors') }}
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{ route('authors.create') }}" class="btn btn-primary btn-icon-split">
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
                                    <th>{{ trans('admin.name') }}</th>
                                    <th class="min text-center">{{ trans('admin.default') }}</th>
                                    <th class="min text-center">{{ trans('admin.active') }}</th>
                                    <th class="min text-center">{{ trans('admin.action') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($authors as $author)
                                    <tr role="row">
                                        <td>{{ $author->name }}</td>
                                        <td class="min text-center">
                                            <input type="checkbox" style="width:20px; height: 20px" id="default" disabled {{ $author->default ? 'checked="checked"' : '' }}>
                                            <label class="form-check-label" for="default"></label>
                                        </td>
                                        <td class="min text-center">
                                            <input type="checkbox" style="width:20px; height: 20px" id="is-active" disabled {{ $author->active ? 'checked="checked"' : '' }}>
                                            <label class="form-check-label" for="is-active"></label>
                                        </td>
                                        <td class="min text-center">
                                            <a href="{{ route('authors.show', $author->id) }}" class="btn btn-light btn-sm">
                                                <span class="icon text-black" data-toggle="tooltip" data-placement="top" title="View">
                                                    <i class="fas fa-eye"></i>
                                                </span>
                                            </a>

                                            <a href="{{ route('authors.edit', $author->id) }}" class="btn btn-light btn-sm">
                                                <span class="icon text-info" data-toggle="tooltip" data-placement="top" title="Edit">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </span>
                                            </a>

                                            <a href="javascript:" data-toggle="modal" data-target="#modalDelete" class="btn btn-light btn-sm" onclick="deleteData('authors', {{$author->id}})">
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
                    <div class="row float-right">
                        <div class="col-sm-12 col-md-7">
                            {{ $authors->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

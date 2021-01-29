@extends('admin.layouts.admin-layout')

@section('title-page')
    News Blog - {{ trans('admin.adverts') }}
@endsection

@section('title-content')
    {{ trans('admin.adverts') }}
@endsection


@section('content')
    @include('admin.modal-delete-index')
    {{ Breadcrumbs::render('advertisements') }}
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{ route('advertisements.create') }}" class="btn btn-primary btn-icon-split">
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
                                @foreach($advertisements as $advertising)
                                    <tr role="row">
                                        <td>{{ $advertising->title }}</td>
                                        <td>{{ $advertising->destination_link }} </td>
                                        <td class="min text-center">
                                            <input type="checkbox" style="width:20px; height: 20px" id="is-active" disabled {{ $advertising->active ? 'checked="checked"' : '' }}>
                                            <label class="form-check-label" for="is-active"></label>
                                        </td>
                                        <td class="min text-center">
                                            <a href="{{ route('advertisements.show', $advertising->id) }}" class="btn btn-light btn-sm">
                                                <span class="icon text-black" data-toggle="tooltip" data-placement="top" title="View">
                                                    <i class="fas fa-eye"></i>
                                                </span>
                                            </a>

                                            <a href="{{ route('advertisements.edit', $advertising->id) }}" class="btn btn-light btn-sm">
                                                <span class="icon text-info" data-toggle="tooltip" data-placement="top" title="Edit">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </span>
                                            </a>

                                            <a href="javascript:" data-toggle="modal" data-target="#modalDelete" class="btn btn-light btn-sm" onclick="deleteData('advertisements', {{$advertising->id}})">
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
                            {{ $advertisements->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

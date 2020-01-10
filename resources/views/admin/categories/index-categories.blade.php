@extends('admin.layouts.admin-layout')

@section('title-page')
    News Blog - Categories
@endsection

@section('title-content')
    Categories
@endsection

@section('content')
    @include('admin.modal-delete-index')
    {{ Breadcrumbs::render('categories') }}
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{ route('categories.create') }}" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-plus-square"></i>
                    </span>
                <span class="text">Create new</span>
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                <thead>
                                <tr role="row" class="d-flex">
                                    <th class="col-6">Name</th>
                                    <th class="col-2">Displays in menu</th>
                                    <th class="col-2">Active</th>
                                    <th class="col-2 text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($categories as $category)
                                    <tr role="row" class="d-flex">
                                        <td class="col-6">{{ $category->name }}</td>
                                        <td class="col-2">{{ $category->displays_in_menu ? 'Yes' : 'No' }} </td>
                                        <td class="col-2">{{ $category->active ? 'Yes' : 'No' }}</td>
                                        <td class="col-2 text-center">
                                            <a href="{{ route('categories.show', $category->id) }}" class="btn btn-light btn-icon-split btn-sm">
                                                <span class="icon text-black" data-toggle="tooltip" data-placement="top" title="View">
                                                    <i class="fas fa-eye"></i>
                                                </span>
                                            </a>
                                            |
                                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-light btn-icon-split btn-sm">
                                                <span class="icon text-info" data-toggle="tooltip" data-placement="top" title="Edit">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </span>
                                            </a>
                                            |
                                            <a href="javascript:" data-toggle="modal" data-target="#modalDelete" class="btn btn-light btn-icon-split btn-sm" onclick="deleteData('categories', {{$category->id}})">
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
                            {{ $categories->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

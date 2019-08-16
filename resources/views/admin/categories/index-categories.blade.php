@extends('admin.layouts.admin-layout')

@section('title-page')
    News Blog - Categories
@endsection

@section('title-content')
    Categories
@endsection

@section('content')


    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="/categories/create" class="btn btn-primary btn-icon-split">
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
                                <tr role="row">
                                    <th>Name</th>
                                    <th>Displays in menu</th>
                                    <th>Active</th>
                                    <th>Created at</th>
                                    <th style="width: 10%">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($categories as $category)
                                    <tr role="row" class="odd">
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->displays_in_menu ? 'Yes' : 'No' }} </td>
                                        <td>{{ $category->active ? 'Yes' : 'No' }}</td>
                                        <td>{{ date_format($category->created_at, 'Y-m-d')  }}</td>
                                        <td>
                                            <a href="/categories/{{ $category->id }}" class="btn btn-light btn-icon-split btn-sm">
                                                <span class="icon text-black-50">
                                                    <i class="fas fa-eye"></i>
                                                </span>
                                                <span class="text">View</span>
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
                            {{ $categories->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

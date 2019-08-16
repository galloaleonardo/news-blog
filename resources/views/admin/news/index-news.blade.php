@extends('admin.layouts.admin-layout')

@section('title-page')
    News Blog - News
@endsection

@section('title-content')
    News
@endsection

@section('content')






    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="/news/create" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-plus-square"></i>
                    </span>
                <span class="text">Create new</span>
            </a>
        </div>
        <div class="card-body">
            <div id="accordion">
                <div class="card shadow mb-4">
                    <div class="card-header py-3" id="headingOne">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFilter" aria-expanded="false" aria-controls="collapseFilter">
                                <i class="fas fa-filter"></i> Click to filter
                            </button>
                        </h5>
                    </div>

                    <div id="collapseFilter" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                            <form>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <input type="email" class="form-control" id="inputEmail4" placeholder="Title">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="text" class="form-control" id="inputPassword4" placeholder="Author">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <select id="inputState" class="form-control">
                                            <option selected>Category</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <select id="inputState" class="form-control">
                                            <option selected>Display order</option>
                                            <option>...</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <select id="inputState" class="form-control">
                                            <option selected>Active</option>
                                            <option>All</option>
                                            <option>Yes</option>
                                            <option>No</option>
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
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
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Display Order</th>
                                    <th>Author</th>
                                    <th>Active</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($news as $new)
                                    <tr role="row" class="odd">
                                        <td>{{ $new->title }}</td>
                                        <td>{{ $new->category_id }}</td>
                                        <td>{{ $new->display_order }}</td>
                                        <td>{{ $new->author }}</td>
                                        <td>
                                            <a href="/categories/{{ $new->id }}" class="btn btn-light btn-icon-split btn-sm">
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
                            {{ $news->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

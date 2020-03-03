@extends('admin.layouts.admin-layout')

@section('title-page')
    News Blog - Categories
@endsection

@section('title-content')
    Categories
@endsection

@section('content')
    {{ Breadcrumbs::render('category-show-edit', $category) }}
    <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        <span class="icon text-danger">
                            <i class="fas fa-trash-alt"></i>
                            DELETE
                        </span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Do you want to remove the registry?</p>
                    <p>This operation is irreversible.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No, close</button>
                    <form method="POST" action="{{ route('categories.destroy', $category->id) }}">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger">Yes, delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning btn-icon-split">
                    <span class="icon text-warning">
                      <i class="fas fa-edit"></i>
                    </span>
                <span class="text">Edit</span>
            </a>
            <a href="#" class="btn btn-danger btn-icon-split" data-toggle="modal" data-target="#modalDelete">
                    <span class="icon text-danger">
                      <i class="fas fa-trash-alt"></i>
                    </span>
                <span class="text">Delete</span>
            </a>
        </div>
        <div class="card-body">
            <div class="card mb-4">
                <div class="card-body">
                    <p class="h4 pb-3 text-primary">Resume:</p>

                    <p class="h5"><strong>Name</strong></p>
                    <input type="text" class="form-control col-md-12 mb-4" value="{{ $category->name }}" readonly="readonly">

                    <p class="h5">
                        <input type="checkbox" style="margin-left: 0" class="form-check-input" id="displays_in_menu" {{ $category->displays_in_menu ? 'checked' : '' }} disabled="disabled">
                        <label class="form-check-label" style="margin-left: 20px" for="displays_in_menu">Displays in menu</label>
                    </p>

                    <p class="h5">
                        <input type="checkbox" style="margin-left: 0" class="form-check-input" id="displays_in_menu" {{ $category->active ? 'checked' : '' }} disabled="disabled">
                        <label class="form-check-label" style="margin-left: 20px" for="displays_in_menu">Active</label>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection

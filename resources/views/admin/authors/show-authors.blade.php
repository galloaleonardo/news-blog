@extends('admin.layouts.admin-layout')

@section('title-page')
    {{ App\Helpers\Helper::getCompanyName() }} - {{ trans('admin.authors') }}
@endsection

@section('title-content')
    {{ trans('admin.authors') }}
@endsection

@section('content')
    {{ Breadcrumbs::render('author-show-edit', $author) }}
    <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        <span class="icon text-danger">
                            <i class="fas fa-trash-alt"></i>
                            {{ trans('admin.delete') }}
                        </span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>{{ trans('admin.want_remove_question') }}</p>
                    <p>{{ trans('admin.operation_irreversible') }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('admin.no_close') }}</button>
                    <form method="POST" action="{{ route('authors.destroy', $author->id) }}">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger">{{ trans('admin.yes_delete') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{ route('authors.edit', $author->id) }}" class="btn btn-warning btn-icon-split">
                    <span class="icon text-warning">
                      <i class="fas fa-edit"></i>
                    </span>
                <span class="text">{{ trans('admin.edit') }}</span>
            </a>
            <a href="#" class="btn btn-danger btn-icon-split" data-toggle="modal" data-target="#modalDelete">
                    <span class="icon text-danger">
                      <i class="fas fa-trash-alt"></i>
                    </span>
                <span class="text">{{ trans('admin.delete') }}</span>
            </a>
        </div>
        <div class="card-body">
            <div class="card mb-4">
                <div class="card-body">
                    <p class="h4 pb-3 text-primary">{{ trans('admin.resume') }}:</p>

                    <p class="h5"><strong>{{ trans('admin.name') }}</strong></p>
                    <input type="text" class="form-control col-md-12 mb-4" value="{{ $author->name }}" readonly="readonly">

                    <p class="h5">
                        <input type="checkbox" style="margin-left: 0" class="form-check-input" id="default" {{ $author->default ? 'checked' : '' }} disabled="disabled">
                        <label class="form-check-label" style="margin-left: 20px" for="default">{{ trans('admin.default') }}</label>
                    </p>

                    <p class="h5">
                        <input type="checkbox" style="margin-left: 0" class="form-check-input" id="active" {{ $author->active ? 'checked' : '' }} disabled="disabled">
                        <label class="form-check-label" style="margin-left: 20px" for="active">{{ trans('admin.active') }}</label>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection

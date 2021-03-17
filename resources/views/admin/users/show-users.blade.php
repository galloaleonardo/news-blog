@extends('admin.layouts.admin-layout')

@section('title-page')
    {{ App\Helpers\Helper::getCompanyName() }} - {{ trans('admin.users') }}
@endsection

@section('title-content')
    {{ trans('admin.users') }}
@endsection

@section('content')
    {{ Breadcrumbs::render('users-show-edit', $user) }}
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
                    <form method="POST" action="{{ route('users.destroy', $user->id) }}">
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
            <a href="{{ route('users.edit', $user->id ) }}" class="btn btn-warning btn-icon-split">
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
            <p class="h5 pb-3 text-primary">{{ trans('admin.resume') }}:</p>
            <p><strong>{{ trans('admin.name') }}:</strong> {{ $user->name }}</p>
            <p><strong>{{ trans('admin.email') }}:</strong> {{ $user->email }}</p>
            <p><strong>{{ trans('admin.admin') }}:</strong> {{ $user->Admin ? trans('admin.yes') : trans('admin.no') }}</p>
            <p><strong>{{ trans('admin.active') }}:</strong> {{ $user->active ? trans('admin.yes') : trans('admin.no') }}</p>
            <p><strong>{{ trans('admin.created_at') }}:</strong> {{ \App\Helpers\Helper::getDateFormatLanguage($user->created_at) }}</p>
        </div>
    </div>
@endsection

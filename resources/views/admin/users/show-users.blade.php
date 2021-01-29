@extends('admin.layouts.admin-layout')

@section('title-page')
    News Blog - {{ trans('admin.users') }}
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

    <!-- Modal PASSWORD !-->
    <div class="modal fade" id="modalPassword" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        <span class="icon">
                            <i class="fas fa-key"></i>
                            {{ trans('admin.change_password') }}
                        </span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>{{ trans('admin.want_change_password_question') }}</p>
                    <p>{{ trans('admin.email_be_sent', ['email' => $user->email]) }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('admin.no_close') }}</button>
                    <button type="submit" class="btn btn-danger">{{ trans('admin.yes_send') }}</button>
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
            <a href="#" class="btn btn-dark btn-icon-split float-md-right" data-toggle="modal" data-target="#modalPassword">
                    <span class="icon text-danger">
                      <i class="fas fa-key"></i>
                    </span>
                <span class="text">Change password</span>
            </a>
        </div>
        <div class="card-body">
            <p class="h4 pb-3 text-primary">{{ trans('admin.resume') }}:</p>
            <p><img src="/images/avatars/{{ $user->avatar }}" alt="..." class="rounded-circle col-1 mb-2"></p>
            <p class="h5"><strong>Name</strong>: {{ $user->name }}</p>
            <p class="h5"><strong>Email:</strong> {{ $user->email }}</p>
            <p class="h5"><strong>Admin:</strong> {{ $user->Admin ? 'Yes' : 'No' }}</p>
            <p class="h5"><strong>Active:</strong> {{ $user->active ? 'Yes' : 'No' }}</p>
            <p class="h5"><strong>Created At:</strong> {{ $user->created_at }}</p>
        </div>
    </div>
@endsection

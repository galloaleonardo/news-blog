@extends('admin.layouts.admin-layout')

@section('title-page')
    News Blog - Users
@endsection

@section('title-content')
    Users
@endsection

@section('content')
    <!-- Modal DELETE -->
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
                    <form method="POST" action="{{ route('users.destroy', $user->id) }}">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger">Yes, delete</button>
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
                            CHANGE PASSWORD
                        </span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Do you want to change the user's password?</p>
                    <p>An email will be sent to <strong>{{ $user->email }}</strong> with instructions.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No, close</button>
                    <button type="submit" class="btn btn-danger">Yes, send</button>
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
                <span class="text">Edit</span>
            </a>
            <a href="#" class="btn btn-danger btn-icon-split" data-toggle="modal" data-target="#modalDelete">
                    <span class="icon text-danger">
                      <i class="fas fa-trash-alt"></i>
                    </span>
                <span class="text">Delete</span>
            </a>
            <a href="#" class="btn btn-dark btn-icon-split float-md-right" data-toggle="modal" data-target="#modalPassword">
                    <span class="icon text-danger">
                      <i class="fas fa-key"></i>
                    </span>
                <span class="text">Change password</span>
            </a>
        </div>
        <div class="card-body">
            <p class="h4 pb-3 text-primary">Resume:</p>
            <p><img src="/images/avatars/{{ $user->avatar }}" alt="..." class="rounded-circle col-1 mb-2"></p>
            <p class="h5"><strong>Name</strong>: {{ $user->name }}</p>
            <p class="h5"><strong>Email:</strong> {{ $user->email }}</p>
            <p class="h5"><strong>Admin:</strong> {{ $user->Admin ? 'Yes' : 'No' }}</p>
            <p class="h5"><strong>Active:</strong> {{ $user->active ? 'Yes' : 'No' }}</p>
            <p class="h5"><strong>Created At:</strong> {{ $user->created_at }}</p>
        </div>
    </div>
@endsection

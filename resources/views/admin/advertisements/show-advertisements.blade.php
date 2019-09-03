@extends('admin.layouts.admin-layout')

@section('title-page')
    News Blog - Advertisements
@endsection

@section('title-content')
    Advertisements
@endsection

@section('content')

    <!-- Modal -->
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
                    <form method="POST" action="{{ route('advertisements.destroy', $advertising->id) }}">
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
            <a href="{{ route('advertisements.edit', $advertising->id) }}" class="btn btn-warning btn-icon-split">
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
            <p class="h4 pb-3 text-primary">Resume:</p>
            <p class="h5"><strong>Title:</strong> {{ $advertising->title }}</p>
            <p class="h5"><strong>Destination Link:</strong> {{ $advertising->destination_link }}</p>
            <p class="h5"><strong>Active:</strong> {{ $advertising->active ? 'Yes' : 'No' }}</p>

            <div class="card my-4">
                <div class="card-body">
                    <p class="h5"><strong>Main Image:<br></strong></p> <img src="/images/announcements/{{ $advertising->image_link }}" alt="">
                </div>
            </div>
        </div>
    </div>
@endsection

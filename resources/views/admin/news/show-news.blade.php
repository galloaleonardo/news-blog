@extends('admin.layouts.admin-layout')

@section('title-page')
    News Blog - News
@endsection

@section('title-content')
    News
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
                    <form method="POST" action="/news/{{ $news->id }}">
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
            <a href="/news/{{ $news->id }}/edit" class="btn btn-warning btn-icon-split">
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
            <p class="h5"><strong>Title: {{ $news->title }}</strong></p>
            <p class="h5 mt-4"><strong>Subtitle</strong>:<br> {{ $news->subtitle }}</p>
            <p class="h5 mt-4"><strong>Category</strong>: {{ $news->category->name }}</p>
            <p class="h5"><strong>Display Order</strong>: {{ $news->display_order }}</p>
            <p class="h5"><strong>Author</strong>: {{ $news->author }}</p>
            <p class="h5"><strong>Link Youtube</strong>: {{ $news->youtube_link }}</p>

            <div class="card shadow my-4">
                <div class="card-body">
                    <p class="h5"><strong>Main Image:<br></strong></p> <img src="/images/news/small/{{ $news->image_link }}" alt="">
                </div>
            </div>

            <div class="card shadow my-4">
                <div class="card-body">
                  <p class="h5"><strong>Content</strong>:<br> {!! $news->content !!}</p>
                </div>
            </div>
        </div>
    </div>
@endsection

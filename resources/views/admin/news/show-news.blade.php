@extends('admin.layouts.admin-layout')

@section('title-page')
    News Blog - News
@endsection

@section('title-content')
    News
@endsection

@section('content')
    {{ Breadcrumbs::render('news-show-edit', $news) }}
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
                    <form method="POST" action="{{ route('news.destroy', $news->id) }}">
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
            <a href="{{ route('news.edit', $news->id) }}" class="btn btn-warning btn-icon-split">
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

                    <p class="h5"><strong>Title</strong></p>
                    <input type="text" class="form-control col-md-12 mb-4" value="{{ $news->title }}" readonly="readonly">

                    <p class="h5"><strong>Subtitle</strong></p>
                    <input type="text" class="form-control col-md-12 mb-4" value="{{ $news->subtitle }}" readonly="readonly">

                    <p class="h5"><strong>Category</strong></p>
                    <input type="text" class="form-control col-md-12 mb-4" value="{{ $news->category->name }}" readonly="readonly">

                    <p class="h5"><strong>Display Order</strong></p>
                    <input type="text" class="form-control col-md-12 mb-4" value="{{ $news->display_order }}" readonly="readonly">

                    <p class="h5"><strong>Author</strong></p>
                    <input type="text" class="form-control col-md-12 mb-4" value="{{ $news->author }}" readonly="readonly">

                    <a class="h4" data-toggle="collapse" href="#collapseImg" role="button" aria-expanded="false" aria-controls="collapseImg">
                        Main Image <i class="fas fa-sort-down"></i>
                    </a>
                    <div class="collapse my-4" id="collapseImg">
                        <div class="card card-body" style="display: grid;">
                            <img class="mb-4" style="width: auto" src="/images/news/small/{{ $news->image_link }}" alt="">
                        </div>
                    </div>

                    <p class="h5 mt-4"><strong>Content</strong></p>
                    <textarea class="form-control" rows="20" readonly="readonly">{{ $news->content }}</textarea>
                </div>
            </div>
        </div>
    </div>
@endsection

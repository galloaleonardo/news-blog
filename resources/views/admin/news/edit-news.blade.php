@extends('admin.layouts.admin-layout')

@section('title-page')
    News Blog - News
@endsection

@section('title-content')
    News
@endsection

@section('content')
    @include('admin.errors')

    <div class="card shadow mb-4">
        <div class="card-header py-3"><i class="fas fa-edit"></i> Update news</div>
        <div class="card-body">
            <form method="POST" action="/news/{{ $news->id }}" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-8">
                        <label for="name">Title</label>
                        <input type="text" class="form-control {{ $errors->has('title') ? 'border-left-danger' : '' }}" id="title" name="title" value="{{ $news->title }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="image_link">Main image - <small>(Max. 1500px x 1500px) - (Max. 800kb)</small></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-images"></i>
                                </span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image_link" name="image_link">
                                <label class="custom-file-label {{ $errors->has('image_link') ? 'border-left-danger' : '' }}" for="image_link">{{ $news->image_link }}</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="subtitle">Subtitle</label>
                    <textarea class="form-control {{ $errors->has('subtitle') ? 'border-left-danger' : '' }}" name="subtitle" id="subtitle">{{ $news->subtitle }}</textarea>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="category_id">Category</label>
                        <select id="category_id" name="category_id" class="form-control {{ $errors->has('category_id') ? 'border-left-danger' : '' }}">
                            <option selected disabled>Choose...</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $category->id == $news->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="display_order">Dispay order</label>
                        <select id="display_order" name="display_order" class="form-control {{ $errors->has('display_order') ? 'border-left-danger' : '' }}">
                            <option selected disabled>Choose...</option>
                            <option value="D" {{ $news->display_order == "D"  ? 'selected' : '' }}>Highlights</option>
                            <option value="R" {{ $news->display_order == "R"  ? 'selected' : '' }}>Recent</option>
                            <option value="L" {{ $news->display_order == "L"  ? 'selected' : '' }}>Lateral</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="author">Author</label>
                        <input type="text" class="form-control {{ $errors->has('author') ? 'border-left-danger' : '' }}" id="author" name="author" value="{{ $news->author }}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="youtube_link">Link Youtube</label>
                        <input type="text" class="form-control" id="youtube_link" name="youtube_link" value="{{ $news->youtube_link }}">
                    </div>
                    <div class="form-group col-md-12">
                        <label class="{{ $errors->has('content') ? 'border-bottom-danger' : '' }}" for="news_content">Content</label>
                        <textarea name="content" id="news_content">{{ $news->content }} </textarea>
                        <script>
                            CKEDITOR.replace('news_content');
                        </script>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="active" name="active" {{ $category->active ? 'checked' : '' }}>
                        <label class="form-check-label" for="active">
                            Active
                        </label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
@endsection

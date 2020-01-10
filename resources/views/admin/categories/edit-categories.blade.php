@extends('admin.layouts.admin-layout')

@section('title-page')
    News Blog - Categories
@endsection

@section('title-content')
    Category
@endsection

@section('content')
    @include('admin.errors')
    {{ Breadcrumbs::render('category-show-edit', $category) }}
    <div class="card shadow mb-4">
        <div class="card-header py-3"><i class="fas fa-edit"></i> Update category</div>
        <div class="card-body">
            <form method="POST" action="{{ route('categories.update', $category->id) }}">
                @method('PATCH')
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name">Name</label>
                        <input type="text" class="form-control {{ $errors->has('name') ? 'border-left-danger' : '' }}" id="name" name="name" value="{{ $category->name }}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="displays_in_menu" name="displays_in_menu" {{ $category->displays_in_menu ? 'checked' : '' }}>
                        <label class="form-check-label" for="displays_in_menu">
                            Displays in menu
                        </label>
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
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection

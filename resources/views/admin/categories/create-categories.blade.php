@extends('admin.layouts.admin-layout')

@section('title-page')
    News Blog - Categories
@endsection

@section('title-content')
    Category
@endsection

@section('content')
    @include('admin.errors')
    {{ Breadcrumbs::render('category-create') }}
    <div class="card shadow mb-4">
        <div class="card-header py-3"><i class="fas fa-plus-square"></i> Create a new category</div>
        <div class="card-body">
            <form method="POST" action="{{ route('categories.store') }}">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name">Name</label>
                        <input type="text" class="form-control {{ $errors->has('name') ? 'border-left-danger' : '' }}" id="name" name="name" value="{{ old('name') }}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="displays_in_menu" name="displays_in_menu" value="{{ old('displays_in_menu') }}">
                        <label class="form-check-label" for="displays_in_menu">
                            Displays in menu
                        </label>
                        <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top" title="This option displays the category name in the home page menu."></i>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="featured" name="featured" value="{{ old('featured') }}">
                        <label class="form-check-label" for="featured">
                            Featured
                        </label>
                        <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top" title="This option displays the category as highlighted on the home page."></i>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="active" name="active" checked>
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

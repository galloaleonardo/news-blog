@extends('admin.layouts.admin-layout')

@section('title-page')
    News Blog - Categories
@endsection

@section('title-content')
    Categories
@endsection

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="/categories/{{ $category->id }}/edit" class="btn btn-warning btn-icon-split">
                    <span class="icon text-warning">
                      <i class="fas fa-edit"></i>
                    </span>
                <span class="text">Edit</span>
            </a>
            <a href="/categories/create" class="btn btn-danger btn-icon-split">
                    <span class="icon text-danger">
                      <i class="fas fa-trash-alt"></i>
                    </span>
                <span class="text">Delete</span>
            </a>
        </div>
        <div class="card-body">
            <p class="h4 pb-3 text-primary">Resume:</p>
            <p class="h5"><strong>Name</strong>: {{ $category->name }}</p>
            <p class="h5"><strong>Displays in menu:</strong> {{ $category->displays_in_menu ? 'Yes' : 'No' }}</p>
            <p class="h5"><strong>Active:</strong> {{ $category->active ? 'Yes' : 'No' }}</p>
        </div>
    </div>
@endsection

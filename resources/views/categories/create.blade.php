@extends('layouts.global')

@section('title')
    Create
@endsection

@section('content')
@section('pageTitle')
    Add Category
@endsection
<form action="{{ route('categories.store') }}" method="post" enctype="multipart/form-data" class="bg-white shadow-sm p-3">
    @csrf
    <div class="form-group row">
        <label for="name" class="col-sm-3 col-form-label">Category Name</label>
        <div class="col-sm-9">
        <input type="text" class="form-control" id="name" name="name" placeholder="Category Name">
        </div>
    </div>
    <div class="form-group row">
        <label for="image" class="col-sm-3 col-form-label">Category Image</label>
        <div class="col-sm-9">
            <input type="file" name="image" id="image" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-10">
        <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </div>
    </form>
@endsection

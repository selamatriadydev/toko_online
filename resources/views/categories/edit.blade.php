@extends('layouts.global')

@section('title')
    Update
@endsection

@section('content')
@section('pageTitle')
    Update Category
@endsection
<form action="{{ route('categories.update', ['id' => $category->id ]) }}" method="post" enctype="multipart/form-data" class="bg-white shadow-sm p-3">
    @csrf
    @method('PUT')
    <div class="form-group row">
        <label for="name" class="col-sm-3 col-form-label">Category Name</label>
        <div class="col-sm-9">
        <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}" placeholder="Category Name">
        </div>
    </div>
    <div class="form-group row">
        <label for="slug" class="col-sm-3 col-form-label">Category Slug</label>
        <div class="col-sm-9">
        <input type="text" class="form-control" id="slug" name="slug" value="{{ $category->slug }}" placeholder="Category Slug">
        </div>
    </div>
    <div class="form-group row">
        <label for="image" class="col-sm-3 col-form-label">Category Image</label>
        <div class="col-sm-9">
            <input type="file" name="image" id="image" class="form-control">
            @if ($category->image)
            <img src="{{ asset('storage/' . $category->image ) }}" alt="Category Image" width="120px">
            @endif
            <span class="text-muted">Kosong jika tidak ingin mengubah Gambar</span>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-10">
        <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </div>
    </form>
@endsection

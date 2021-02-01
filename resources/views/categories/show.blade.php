@extends('layouts.global')

@section('title')
    Show
@endsection

@section('content')
@section('pageTitle')
    Show Category
@endsection
    <div class="form-group row">
        <label for="name" class="col-sm-3 col-form-label"></label>
        <div class="col-sm-9">
            @if ($category->image)
            <img src="{{ asset('storage/' . $category->image ) }}" alt="Category Image" width="120px">
            @endif
            <br>
        {{ $category->name }}
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-10">
        <a href="/categories" class="btn btn-primary">Back</a>
        </div>
    </div>
@endsection

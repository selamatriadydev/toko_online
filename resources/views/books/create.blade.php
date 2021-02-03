@extends('layouts.global')

@section('title')
    Create
@endsection

@section('content')
@section('pageTitle')
    Add Books
@endsection
<form action="{{ route('books.store') }}" method="post" enctype="multipart/form-data" class="bg-white shadow-sm p-3">
    @csrf
    <div class="form-group row">
        <label for="title" class="col-sm-3 col-form-label">Title</label>
        <div class="col-sm-9">
        <input type="text" class="form-control" id="title" name="title" placeholder="Title">
        </div>
    </div>
    <div class="form-group row">
        <label for="cover" class="col-sm-3 col-form-label">Cover</label>
        <div class="col-sm-9">
            <input type="file" name="cover" id="cover" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="description" class="col-sm-3 col-form-label">Description</label>
        <div class="col-sm-9">
        <textarea name="description" id="description" class="form-control" placeholder="Give a description about this book"></textarea>
        </div>
    </div>
    <div class="form-group row">
        <label for="stock" class="col-sm-3 col-form-label">Stock</label>
        <div class="col-sm-9">
        <input type="number" class="form-control" id="stock" name="stock" placeholder="Book Stock">
        </div>
    </div>
    <div class="form-group row">
        <label for="author" class="col-sm-3 col-form-label">Author</label>
        <div class="col-sm-9">
        <input type="text" class="form-control" id="author" name="author" placeholder="Book Author">
        </div>
    </div>
    <div class="form-group row">
        <label for="publisher" class="col-sm-3 col-form-label">Publisher</label>
        <div class="col-sm-9">
        <input type="text" class="form-control" id="publisher" name="publisher" placeholder="Book Publisher">
        </div>
    </div>
    <div class="form-group row">
        <label for="categories" class="col-sm-3 col-form-label">Categories</label>
        <div class="col-sm-9">
        <select name="categories[]" id="categories" class="form-control" multiple></select>
        </div>
    </div>
    <div class="form-group row">
        <label for="price" class="col-sm-3 col-form-label">Price</label>
        <div class="col-sm-9">
        <input type="number" class="form-control" id="price" name="price" placeholder="Book Price">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-10">
        <button  class="btn btn-primary" name="save_action" value="PUBLISH">Publish</button>
        <button  class="btn btn-secondary" name="save_action" value="DRAFT">Save as Draft</button>
        </div>
    </div>
    </form>

    @section('footer-script')
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $('#categories').select2({
            ajax: {
                url : 'http://127.0.0.1:8000/ajax/categories/search',
                processResults: function (data){
                    return {
                        results: data.map(function(item) {return { id : item.id, text : item.name }})
                    }
                }
            }
        });
    </script>
    @endsection
@endsection

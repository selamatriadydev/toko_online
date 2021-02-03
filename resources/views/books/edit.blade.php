@extends('layouts.global')

@section('title')
    Update
@endsection

@section('content')
@section('pageTitle')
    Update Books
@endsection
<form action="{{ route('books.update', ['id' => $book->id]) }}" method="post" enctype="multipart/form-data" class="bg-white shadow-sm p-3">
    @csrf
    @method('PUT')
    <div class="form-group row">
        <label for="title" class="col-sm-3 col-form-label">Title</label>
        <div class="col-sm-9">
        <input type="text" class="form-control" id="title" name="title" value="{{ $book->title }}" placeholder="Title">
        </div>
    </div>
    <div class="form-group row">
        <label for="cover" class="col-sm-3 col-form-label">Cover</label>
        <div class="col-sm-9">
            <input type="file" name="cover" id="cover" class="form-control">
            @if ($book->cover)
                {{-- <input type="hidden" name="cover_old" id="cover_old" value="{{ $book->cover }}"> --}}
                <img src="{{ asset('storage/' . $book->cover) }}" alt="cover this book" width="120px">
            @endif
            <br><span class="text-muted">Kosongkan Jika Tidak Ingin Mengubah Cover</span>
        </div>
    </div>
    <div class="form-group row">
        <label for="slug" class="col-sm-3 col-form-label">Slug</label>
        <div class="col-sm-9">
        <input type="text" class="form-control" id="slug" name="slug" value="{{ $book->slug }}" placeholder="Book slug">
        </div>
    </div>
    <div class="form-group row">
        <label for="description" class="col-sm-3 col-form-label">Description</label>
        <div class="col-sm-9">
        <textarea name="description" id="description" class="form-control" placeholder="Give a description about this book">{{ $book->description }}</textarea>
        </div>
    </div>
    <div class="form-group row">
        <label for="categories" class="col-sm-3 col-form-label">Categories</label>
        <div class="col-sm-9">
        <select name="categories[]" id="categories" class="form-control" multiple></select>
        </div>
    </div>
    <div class="form-group row">
        <label for="stock" class="col-sm-3 col-form-label">Stock</label>
        <div class="col-sm-9">
        <input type="number" class="form-control" id="stock" name="stock" value="{{ $book->stock }}" placeholder="Book Stock">
        </div>
    </div>
    <div class="form-group row">
        <label for="author" class="col-sm-3 col-form-label">Author</label>
        <div class="col-sm-9">
        <input type="text" class="form-control" id="author" name="author" value="{{ $book->author }}" placeholder="Book Author">
        </div>
    </div>
    <div class="form-group row">
        <label for="publisher" class="col-sm-3 col-form-label">Publisher</label>
        <div class="col-sm-9">
        <input type="text" class="form-control" id="publisher" name="publisher" value="{{ $book->publisher }}" placeholder="Book Publisher">
        </div>
    </div>
    <div class="form-group row">
        <label for="price" class="col-sm-3 col-form-label">Price</label>
        <div class="col-sm-9">
        <input type="number" class="form-control" id="price" name="price" value="{{ $book->price }}" placeholder="Book Price">
        </div>
    </div>
    <div class="form-group row">
        <label for="save_action" class="col-sm-3 col-form-label">Status</label>
        <div class="col-sm-9">
            <select name="save_action" id="save_action" class="form-control">
                <option value="PUBLISH" {{ $book->status == "PUBLISH" ? "selected" : "" }}>PUBLISH</option>
                <option value="DRAFT" {{ $book->status == "DRAFT" ? "selected" : "" }}>DRAFT</option>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-10">
        <button type="submit"  class="btn btn-primary" >Update</button>
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
        var categories = {!! $book->categories !!}
        categories.forEach(function(category){
            var option = new Option(category.name, category.id, true, true);
            $('#categories').append(option).trigger('change');
        });
    </script>
    @endsection
@endsection

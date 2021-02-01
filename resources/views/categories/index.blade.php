@extends('layouts.global')

@section('title')
     Category
@endsection

@section('content')
@section('pageTitle')
    List Category halaman 245
@endsection

<div class="row">
    <div class="col-md-6">
        <form action="{{ route('categories.index') }}">
            <div class="input-group">
                <input type="text" name="name" id="name" value="" placeholder="Filter berdasarkan nama" class="form-control col-md-10">
                <div class="input-group-append">
                    <input type="submit" value="Filter" class="btn btn-primary">
                    <a class="btn btn-warning" href="/categories">Reset</a>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-6">
        <ul class="nav nav-pills card-header-pills">
            <li class="nav-item"><a href="{{ route('categories.index') }}" class="nav-link active">Published</a></li>
            <li class="nav-item"><a href="{{ route('categories.trash') }}" class="nav-link">Trash</a></li>
        </ul>
    </div>
</div>
<br>
<a class="btn btn-primary mb-2" href="{{ route('categories.create') }}">Tambah</a>
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<table class="table table-bordered">
    <thead class="border-0">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Slug</th>
        <th scope="col">Image</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($list_category as $key=> $category)
           <tr>
             <th scope="row">{{ $key+1 }}</th>
             <td>{{ $category->name }}</td>
             <td>{{ $category->slug }}</td>
             <td>
                 @if ( $category->image)
                     <img src="{{ asset('storage/'. $category->image) }}" width="70px"/>
                @else
                N/A
                 @endif
             </td>
             <td>
                <a class="btn btn-info mb-2" href="{{ route('categories.show', ['id'=> $category->id ]) }}">Detail</a>
                <a class="btn btn-warning mb-2" href="{{ route('categories.edit', ['id'=> $category->id ]) }}">Edit</a>
                <form action="{{ route('categories.destroy', ['id' => $category->id]) }}" method="post" class="d-inline" onsubmit="return confirm('Delete Category ?')">
                    @csrf
                    @method("DELETE")
                    <button type="submit" class="btn btn-danger mb-2">Delete</button>
                </form>
             </td>
           </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="5">
                {{-- {{ $list_category->links() }} --}}
                {{ $list_category->appends(Request::all())->links() }}
            </td>
        </tr>
    </tfoot>
</table>

@endsection

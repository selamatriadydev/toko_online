@extends('layouts.global')

@section('title')
     Books
@endsection

@section('content')
@section('pageTitle')
    List Books halaman 275
@endsection

<div class="row">
    <div class="col-md-6">
        {{-- <form action="{{ route('books.index') }}">
            <div class="input-group">
                <input type="text" name="name" id="name" value="" placeholder="Filter berdasarkan nama" class="form-control col-md-10">
                <div class="input-group-append">
                    <input type="submit" value="Filter" class="btn btn-primary">
                    <a class="btn btn-warning" href="/categories">Reset</a>
                </div>
            </div>
        </form> --}}
    </div>
    <div class="col-md-6 ">
        <ul class="nav nav-pills card-header-pills">
            <li class="nav-item"><a href="{{ route('books.index') }}" class="nav-link {{ Request::get('status')== NULL && Request::path()=='books' ? 'active' : '' }}">All</a></li>
            <li class="nav-item"><a href="{{ route('books.index', ['status' => 'publlish']) }}" class="nav-link {{ Request::get('status')== 'publish' ? 'active' : '' }}">Publish</a></li>
            <li class="nav-item"><a href="{{ route('books.index', ['status' => 'draft']) }}" class="nav-link {{ Request::get('status')== 'draft' ? 'active' : '' }}">Draft</a></li>
            <li class="nav-item"><a href="{{ route('books.trash') }}" class="nav-link {{ Request::path()=='books.trash' ? 'active' : '' }}">Trash</a></li>
        </ul>
    </div>
</div>
<br>
<div class="col-md-12 text-right">
    <a class="btn btn-primary mb-2" href="{{ route('books.create') }}">Tambah</a>
</div>
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<table class="table table-bordered">
    <thead class="border-0">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Cover</th>
        <th scope="col">Title</th>
        <th scope="col">Author</th>
        <th scope="col">Status</th>
        <th scope="col">Categories</th>
        <th scope="col">Stock</th>
        <th scope="col">Price</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($list_books as $key=> $books)
           <tr>
             <th scope="row">{{ $key+1 }}</th>
             <td>
                 @if ( $books->cover)
                     <img src="{{ asset('storage/'. $books->cover) }}" width="70px"/>
                @else
                N/A
                 @endif
             </td>
             <td>{{ $books->title }}</td>
             <td>{{ $books->author }}</td>
             <td>
                 @if ($books->status == "DRAFT")
                     <span class="badge badge-dark text-white">{{ $books->status }}</span>
                     @else
                     <span class="badge badge-success">{{ $books->status }}</span>
                 @endif
             </td>
             <td>
                 <ul class="pl-3">
                     @foreach ($books->categories as $category)
                         <li>{{ $category->name }}</li>
                     @endforeach
                 </ul>
             </td>
             <td>{{ $books->stock }}</td>
             <td>{{ $books->price }}</td>
             <td>
                <a class="btn btn-info mb-2" href="{{ route('books.show', ['id'=> $books->id ]) }}">Detail</a>
                <a class="btn btn-warning mb-2" href="{{ route('books.edit', ['id'=> $books->id ]) }}">Edit</a>
                <form action="{{ route('books.destroy', ['id' => $books->id]) }}" method="post" class="d-inline" onsubmit="return confirm('Move Book {{ $books->title }} to trash ?')">
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
                {{ $list_books->appends(Request::all())->links() }}
            </td>
        </tr>
    </tfoot>
</table>

@endsection

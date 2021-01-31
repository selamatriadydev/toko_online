@extends('layouts.global')

@section('title')
    List User
@endsection

@section('content')
@section('pageTitle')
    List User halaman 201
@endsection
<a class="btn btn-primary mb-2" href="{{ route('users.create') }}">Tambah</a>
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
        <th scope="col">Username</th>
        <th scope="col">Email</th>
        <th scope="col">Avatar</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($list_user as $user)
           <tr>
             <th scope="row">1</th>
             <td>{{ $user->name }}</td>
             <td>{{ $user->username }}</td>
             <td>{{ $user->email }}</td>
             <td>
                 @if ( $user->avatar)
                     <img src="{{ asset('storage/'. $user->avatar) }}" width="70px"/>
                @else
                N/A
                 @endif
             </td>
             <td>
                <a class="btn btn-info mb-2" href="{{ route('users.show', ['id'=> $user->id ]) }}">Detail</a>
                <a class="btn btn-warning mb-2" href="{{ route('users.edit', ['id'=> $user->id ]) }}">Edit</a>
                <form action="{{ route('users.destroy', ['id' => $user->id]) }}" method="post" class="d-inline" onsubmit="return confirm('Delete User Permanently ?')">
                    @csrf
                    @method("DELETE")
                    <button type="submit" class="btn btn-danger mb-2">Delete</button>
                </form>
             </td>
           </tr>
        @endforeach
    </tbody>
</table>
@endsection

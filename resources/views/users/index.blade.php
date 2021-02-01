@extends('layouts.global')

@section('title')
    List User
@endsection

@section('content')
@section('pageTitle')
    List User halaman 201
@endsection
<form action="{{ route('users.index') }}">
    <div class="row">
        <div class="col-md-6">
            <div class="input-group">
                <input type="text" name="keyword" id="keyword" value="{{ $keyword }}" placeholder="Filter berdasarkan email" class="form-control col-md-10">
            </div>
        </div>
        <div class="col-md-4">
            <div class="input-group">
                <input type="radio" {{ $keyword_status=="ACTIVE" ? "checked": "" }} class="form-control" id="ACTIVE" value="ACTIVE" name="status" >
                <label for="ACTIVE">Active</label>
                <input type="radio" {{ $keyword_status=="INACTIVE" ? "checked": "" }} class="form-control" id="INACTIVE" value="INACTIVE" name="status" >
                <label for="INACTIVE">Inactive</label>
                <div class="input-group-append">
                    <input type="submit" value="Filter" class="btn btn-primary">
                    <a class="btn btn-warning" href="/users">Reset</a>
                </div>
            </div>
        </div>
    </div>
</form>
<br>
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
        <th scope="col">Status</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($list_user as $key=> $user)
           <tr>
             <th scope="row">{{ $key+1 }}</th>
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
                @if ($user->status == "ACTIVE")
                    <span class="badge badge-success">{{ $user->status }}</span>
                @else
                    <span class="badge badge-danger">{{ $user->status }}</span>
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
    <tfoot>
        <tr>
            <td colspan="7">
                {{-- setelah pindah paginasi keyword pencarian hilang, tambahkan appens supaya tidak hilang  --}}
                {{ $list_user->appends(Request::all())->links() }}
            </td>
        </tr>
    </tfoot>
</table>

@endsection

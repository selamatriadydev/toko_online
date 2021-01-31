@extends('layouts.global')

@section('title')
    Update
@endsection

@section('content')
@section('pageTitle')
    Update User {{ $user->name }}
@endsection
<form action="{{ route('users.update', ['id' => $user->id]) }}" method="post" enctype="multipart/form-data" class="bg-white shadow-sm p-3">
    @csrf
    @method('PUT')
    <div class="form-group row">
        <label for="name" class="col-sm-3 col-form-label">Name</label>
        <div class="col-sm-9">
        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" placeholder="Full Name">
        </div>
    </div>
    <div class="form-group row">
        <label for="username" class="col-sm-3 col-form-label">Username</label>
        <div class="col-sm-9">
        <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}" placeholder="Username">
        </div>
    </div>
    <div class="form-group row">
        <label for="roles" class="col-sm-3 col-form-label">Status</label>
        <div class="col-sm-9">
        <input type="radio" {{ $user->status=="ACTIVE" ? "checked": "" }} class="form-control" id="ACTIVE" value="ACTIVE" name="status" >
        <label for="ACTIVE">Active</label>
        <input type="radio" {{ $user->status=="INACTIVE" ? "checked": "" }} class="form-control" id="INACTIVE" value="INACTIVE" name="status" >
        <label for="INACTIVE">Inactive</label>
        </div>
    </div>
    <div class="form-group row">
        <label for="roles" class="col-sm-3 col-form-label">Roles</label>
        <div class="col-sm-9">
        <input type="checkbox"
        {{ in_array('ADMIN', json_decode($user->roles)) ? "checked" : "" }}
        class="form-control" id="ADMIN" value="ADMIN" name="roles[]" >
        <label for="ADMIN">Administrator</label>
        <input type="checkbox"
        {{ in_array('STAFF', json_decode($user->roles)) ? "checked" : "" }}
        class="form-control" id="STAFF" value="STAFF" name="roles[]" >
        <label for="STAFF">Staf</label>
        <input type="checkbox"
        {{ in_array('CUSTOMER', json_decode($user->roles)) ? "checked" : "" }}
         class="form-control" id="CUSTOMER" value="CUSTOMER" name="roles[]" >
        <label for="CUSTOMER">Customer</label>
        </div>
    </div>
    <div class="form-group row">
        <label for="phone" class="col-sm-3 col-form-label">Phone Number</label>
        <div class="col-sm-9">
        <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}" placeholder="Phone Number">
        </div>
    </div>
    <div class="form-group row">
        <label for="address" class="col-sm-3 col-form-label">Address</label>
        <div class="col-sm-9">
        <textarea  class="form-control" id="address" name="address" placeholder="Address">{{ $user->address }}</textarea>
        </div>
    </div>
    <div class="form-group row">
        <label for="avatar" class="col-sm-3 col-form-label">Avatar</label>
        <div class="col-sm-9">
            <input type="file" name="avatar" id="avatar" class="form-control">
            @if ($user->avatar)
                <img src="{{ asset('storage/'. $user->avatar) }}" width="120px"/>
            @else
                NO Avatar
            @endif
            <small class="text-muted">Kosongkan jika tidak ingin mengubah avatar</small>
        </div>
    </div>
    <div class="form-group row">
        <label for="email" class="col-sm-3 col-form-label">Email</label>
        <div class="col-sm-9">
            <input type="email" name="email" id="email" value="{{ $user->email }}" class="form-control">
        </div>
    </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-10">
        <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </div>
    </form>
@endsection

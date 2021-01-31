@extends('layouts.global')

@section('title')
    Detail
@endsection

@section('content')
@section('pageTitle')
    Detail User {{ $user->name }}
@endsection
    <div class="form-group row">
        <label for="name" class="col-sm-3 col-form-label">Name</label>
        <div class="col-sm-9">
            {{ $user->name }}
        </div>
    </div>
    <div class="form-group row">
        <label for="username" class="col-sm-3 col-form-label">Username</label>
        <div class="col-sm-9">
            {{ $user->username }}
        </div>
    </div>
    <div class="form-group row">
        <label for="roles" class="col-sm-3 col-form-label">Status</label>
        <div class="col-sm-9">
            {{ $user->status }}
        </div>
    </div>
    <div class="form-group row">
        <label for="roles" class="col-sm-3 col-form-label">Roles</label>
        <div class="col-sm-9">
            @foreach (json_decode($user->roles) as $role)
                &middot; {{ $role }} <br>
            @endforeach
        </div>
    </div>
    <div class="form-group row">
        <label for="phone" class="col-sm-3 col-form-label">Phone Number</label>
        <div class="col-sm-9">
            {{ $user->phone }}
        </div>
    </div>
    <div class="form-group row">
        <label for="address" class="col-sm-3 col-form-label">Address</label>
        <div class="col-sm-9">
            {{ $user->address }}
        </div>
    </div>
    <div class="form-group row">
        <label for="avatar" class="col-sm-3 col-form-label">Avatar</label>
        <div class="col-sm-9">
            @if ($user->avatar)
                <img src="{{ asset('storage/'. $user->avatar) }}" width="120px"/>
            @else
                NO Avatar
            @endif
        </div>
    </div>
    <div class="form-group row">
        <label for="email" class="col-sm-3 col-form-label">Email</label>
        <div class="col-sm-9">
            {{ $user->email }}
        </div>
    </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-10">
        <a class="btn btn-info mb-2" href="/users">Back</a>
        </div>
    </div>
@endsection

@extends('layouts.global')

@section('title')
    Create
@endsection

@section('content')
@section('pageTitle')
    Add User
@endsection

                    <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data" class="bg-white shadow-sm p-3">
                        @csrf
                        <div class="form-group row">
                          <label for="name" class="col-sm-3 col-form-label">Name</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Full Name">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="username" class="col-sm-3 col-form-label">Username</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="roles" class="col-sm-3 col-form-label">Roles</label>
                          <div class="col-sm-9">
                            <input type="checkbox" class="form-control" id="ADMIN" value="ADMIN" name="roles[]" >
                            <label for="ADMIN">Administrator</label>
                            <input type="checkbox" class="form-control" id="STAFF" value="STAFF" name="roles[]" >
                            <label for="STAFF">Staf</label>
                            <input type="checkbox" class="form-control" id="CUSTOMER" value="CUSTOMER" name="roles[]" >
                            <label for="CUSTOMER">Customer</label>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="phone" class="col-sm-3 col-form-label">Phone Number</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone Number">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="address" class="col-sm-3 col-form-label">Address</label>
                          <div class="col-sm-9">
                            <textarea  class="form-control" id="address" name="address" placeholder="Phone Number"></textarea>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="avatar" class="col-sm-3 col-form-label">Avatar</label>
                          <div class="col-sm-9">
                              <input type="file" name="avatar" id="avatar" class="form-control">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="email" class="col-sm-3 col-form-label">Email</label>
                          <div class="col-sm-9">
                              <input type="email" name="email" id="email" class="form-control">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputPassword3" class="col-sm-3 col-form-label">Password</label>
                          <div class="col-sm-9">
                            <input type="password" class="form-control" id="inputPassword3" name="password" placeholder="Password">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="password_confirmation" class="col-sm-3 col-form-label">Confirm Password</label>
                          <div class="col-sm-9">
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Password">
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Save</button>
                          </div>
                        </div>
                      </form>
@endsection

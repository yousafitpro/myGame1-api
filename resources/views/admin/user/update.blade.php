@extends('layouts.dashboard')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h3>Update User</h3>
                    </div>
                    <div class="card-body">
                        <h3>Profile</h3>
                        <hr>
                        <form action="{{route('admin.user.update',$user->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-4">
                                        <img style="max-width: 100px; max-height: 100px;" src="{{asset($user->profile_image)}}">
                                        <br>
                                        <br>
                                        <input type="file" name="image"  placeholder="Select Image" accept="image/x-png,image/gif,image/jpeg">
                                    </div>
                                    <div class="col-md-4">
                                        <label>Email</label><br>
                                        <input class="form-control" required disabled  name="email" value="{{$user->email}}">
                                    </div>
                                    <div class="col-md-4">
                                        <label>Password</label><br>
                                        <input class="form-control" name="password" value="">
                                    </div>

                                </div>
                                <br>
                                <br>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>First Name:</label>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Last Name:</label>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Phone:</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <input class="form-control" required name="fname" value="{{$user->fname}}">
                                    </div>
                                    <div class="col-md-4">
                                        <input class="form-control" required name="lname" value="{{$user->lname}}">
                                    </div>
                                    <div class="col-md-4">
                                        <input class="form-control" required name="phone" value="{{$user->phone}}">
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <textarea class="form-control" required style="height:110px" placeholder="Address" name="address">{{$user->address}}</textarea>
                                    </div>

                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Role: </label>
                                        <select name="role_id">
                                            <option value="{{$user->role->id}}">{{$user->role->name}}</option>
                                            @foreach($roles as $role)
                                                <option value="{{$role->id}}">{{$role->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button class="btn btn-success float-right" type="submit">Update</button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>
@endsection

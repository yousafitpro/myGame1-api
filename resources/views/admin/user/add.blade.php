@extends('layouts.dashboard')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h3>Add User</h3>
                    </div>
                    <div class="card-body">
                        @include('errorBars.errorsArray',['title' => 'Error','errors'=>$errors])
                        <h3>Add New User</h3>
                        <hr>
                        <form action="{{route('admin.user.add')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Profile Image</label><br>                                        <br>
                                        <br>
                                        <input type="file"  name="image" placeholder="Select Image" accept="image/x-png,image/gif,image/jpeg">
                                    </div>
                                    <div class="col-md-4">
                                        <label>Email</label><br>
                                        <input class="form-control" name="email" required value="">
                                    </div>
                                    <div class="col-md-4">
                                        <label>Password</label><br>
                                        <input class="form-control" type="password" name="password" required value="">
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
                                        <input class="form-control" name="fname" required value="">
                                    </div>
                                    <div class="col-md-4">
                                        <input class="form-control" name="lname" required value="">
                                    </div>
                                    <div class="col-md-4">
                                        <input class="form-control" name="phone" required value="">
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <textarea class="form-control" style="height:110px" required placeholder="Address" name="address"></textarea>
                                    </div>

                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Role: </label>
                                        <select name="role_id">
                                            @foreach($roles as $role)
                                            <option value="{{$role->id}}">{{$role->name}}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button class="btn btn-success float-right" type="submit">Add User</button>
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

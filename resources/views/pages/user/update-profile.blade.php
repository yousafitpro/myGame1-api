@extends('layouts.dashboard')
@section('content')
  <div class="container-fluid">
      <div class="row">
          <div class="col-md-8">
              <div class="card">

                  <div class="card-body">
                      <h3>Profile</h3>
                      <hr>
                      <form action="{{route('user.showProfile')}}" method="post" enctype="multipart/form-data">
                          @csrf
                          <div class="container-fluid">
                              <div class="row">
                                  <div class="col-md-4">
                                      <img style="max-width: 100px; max-height: 100px;" src="{{asset($user->profile_image)}}">
                                      <br>
                                      <br>
                                      <input type="file" name="image" placeholder="Select Image" accept="image/x-png,image/gif,image/jpeg">
                                  </div>
                                  <div class="col-md-8">
                                      <label>Email</label><br>
                                      <small>{{$user->email}}</small>
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
                                      <input class="form-control" name="fname" value="{{$user->fname}}">
                                  </div>
                                  <div class="col-md-4">
                                      <input class="form-control" name="lname" value="{{$user->lname}}">
                                  </div>
                                  <div class="col-md-4">
                                      <input class="form-control" name="phone" value="{{$user->phone}}">
                                  </div>
                              </div>
                              <br>
                              <div class="row">
                                  <div class="col-md-12">
                                      <textarea class="form-control" style="height:110px" placeholder="Address" name="address">{{$user->address}}</textarea>
                                  </div>

                              </div>
                              <br>
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
     <div class="col-md-4">
         <form action="{{route('user.resetPassword')}}" method="post">
             @csrf
         <div class="card">

             <div class="card-body">
                 <div class="row">
                     <div class="col-md-12">
                         <label >
                            Enter  New Password
                         </label>
                         <br>
                     </div>
                 </div>
                 <div class="row">
                     <div class="col-md-12">
                         <input type="password" required class="form-control" name="password">
                     </div>
                 </div>
                 <br>
                 <div class="row">
                     <div class="col-md-12 d-inline-flex">
                        <button class="btn btn-primary" type="submit">Reset Password</button>
                     </div>
                 </div>
             </div>
         </div>
         </form>
     </div>
      </div>
  </div>
@endsection

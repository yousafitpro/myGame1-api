@extends('layouts.dashboard')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <form action="{{route('admin.webConfig.updateConfig')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card">

                        <div class="card-body">
                            @include('errorBars.errorsArray',['title' => 'Error','errors'=>$errors])
                            <div class="row">
                                <div class="col-md-6">
                                    <label >
                                       Company Name
                                    </label>
                                    <br>
                                </div>
                                <div class="col-md-6">
                                    <label >
                                    Company Short Name
                                    </label>
                                    <br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <input  required class="form-control" name="company_name" value="{{$config->company_name}}">
                                </div>
                                <div class="col-md-6">
                                    <input  required class="form-control" name="company_short_name" value="{{$config->company_short_name}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label >
                                        Company Email
                                    </label>
                                    <br>
                                </div>
                                <div class="col-md-6">
                                    <label >
                                        Company Phone
                                    </label>
                                    <br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <input  required class="form-control" name="company_email" value="{{$config->company_email}}">
                                </div>
                                <div class="col-md-6">
                                    <input  required class="form-control" name="company_phone" value="{{$config->company_phone}}">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <label >
                                        Company Address
                                    </label>
                                    <br>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input  required class="form-control" name="company_address" value="{{$config->company_address}}">
                                </div>

                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <label >
                                       Logo <br>


                                    </label>
                                    <br>
                                </div>
                                <div class="col-md-6">
                                    <label >
                                        Locale
                                    </label>
                                    <br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <img style="max-width: 100px; max-height: 100px;" src="{{asset($config->company_logo)}}">
                                    <br>
                                    <br>
                                    <input type="file" class="form-control" accept="image/x-png,image/gif,image/jpeg" name="company_logo">
                                </div>
                                <div class="col-md-6">
                                    <select name="mylocale" class="form-control">
                                        <option value="{{asset($config->locale)}}">{{asset($config->locale)}}</option>
                                        <option value="en">en</option>

                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <label >
                                        Backend Navbar Color
                                    </label>
                                    <br>
                                </div>
                                <div class="col-md-6">
                                    <label >
                                        Backend Navbar Position
                                    </label>
                                    <br>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <input  required  name="backend_navbar_color" value="{{$config->backend_navbar_color}}" type="color">
                                </div>
                                <div class="col-md-6">
                                    <select name="backend_navbar_position" class="form-control">
                                        <option value="{{$config->backend_navbar_position}}">{{$config->backend_navbar_position}}</option>
                                        <option value="top">top</option>
                                        <option value="bottom">bottom</option>
                                        <option value="right">left</option>
                                        <option value="right">right</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <label >
                                        Frontend Navbar Color
                                    </label>
                                    <br>
                                </div>
                                <div class="col-md-6">
                                    <label >
                                        Frontend Navbar Position
                                    </label>
                                    <br>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <input  required  value="{{$config->front_navbar_color}}" name="front_navbar_color" type="color">
                                </div>
                                <div class="col-md-6">
                                    <select name="front_navbar_position" class="form-control">
                                        <option value="{{$config->front_navbar_position}}">{{$config->front_navbar_position}}</option>
                                        <option value="top">top</option>
                                        <option value="bottom">bottom</option>
                                        <option value="right">left</option>
                                        <option value="right">right</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12 ">
                                    <button class="btn btn-primary float-right" type="submit">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>
@endsection

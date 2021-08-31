@extends('layouts.dashboard')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
    <form action="{{route('admin.role.add')}}" method="post">
        @csrf
        <div class="card">
            <div class="card-header">
                <h3>Add Role</h3>
            </div>
            <div class="card-body">
                @include('errorBars.errorsArray',['title' => 'Error','errors'=>$errors])
                <div class="row">
                    <div class="col-md-12">
                        <label >
                           Name
                        </label>
                        <br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <input  required class="form-control" name="name">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12 ">
                        <button class="btn btn-primary float-right" type="submit">Add Role</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
            <div class="col-md-4"></div>
        </div>
    </div>
@endsection

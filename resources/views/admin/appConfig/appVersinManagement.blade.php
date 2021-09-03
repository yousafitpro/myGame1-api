@extends('layouts.dashboard')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3>All Apps</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">

                    <a href="#" data-toggle="modal" data-target="#addModel">  <button class="btn btn-primary float-right"> Add New</button></a>
                </div>
            </div>
            <br>
            <div class="table-responsive">
                <table class="table  table-bordered table-hover dataTables-example" >
                    <thead>
                    <tr>
                        <th>App Name</th>
                        <th>App ID</th>
                        <th>Version</th>
                        <th>Link</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($list as $item)
                        <tr class="center">
                            <td>{{$item->app_name}}</td>
                            <td>{{$item->app_id}}</td>
                            <td>{{$item->app_version}}</td>
                            <td><a target="_blank" href="{{$item->app_link}}">{{$item->app_link}}</a> </td>
                            <td width="50px">
                                <div class="dropdown dropdown-menu-bottom">
                                    <i class="fa fa-cogs" data-toggle="dropdown"></i>

                                    <ul class="dropdown-menu">
                                        <li><a href="#" data-toggle="modal" data-target="#editModel{{$item->id}}">Edit/View</a></li>
                                        <li><a href="#" data-toggle="modal" data-target="#deleteModel">Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <div class="modal fade" id="editModel{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Add New App</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <form action="{{route('admin.app.update',$item->id)}}" method="post">
                                        @csrf


                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label >
                                                        Name
                                                    </label>
                                                    <br>
                                                    <input  required class="form-control" name="app_name" value="{{$item->app_name}}" type="text">
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label >
                                                        Version
                                                    </label>
                                                    <br>
                                                    <input  required class="form-control" value="{{$item->version}}" name="version" type="text">
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label >
                                                        App ID
                                                    </label>
                                                    <br>
                                                    <input  required class="form-control" value="{{$item->app_id}}" name="app_id" type="text">
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label >
                                                        Link
                                                    </label>
                                                    <br>
                                                    <input  required class="form-control" name="app_link" value="{{$item->app_link}}" type="text">
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-12 ">
                                                    <button class="btn btn-primary float-right" type="submit">Update App</button>
                                                </div>
                                            </div>
                                        </div>

                                    </form>


                                </div>
                            </div>
                        </div>

                        {{--            Delete Moel--}}
                        <div class="modal fade" id="deleteModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Alert</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h3>Are you want to Delete this ?</h3>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <a href="{{route('admin.app.deleteOne',$item->id)}}"> <button type="button" class="btn btn-primary">Yes</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>App Name</th>
                        <th>App ID</th>
                        <th>Version</th>
                        <th>Link</th>
                        <th>Actions</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
            {{--            Add Moel--}}
            <div class="modal fade" id="addModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Add New App</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                            <form action="{{route('admin.app.add')}}" method="post">
                                @csrf


                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label >
                                                    Name
                                                </label>
                                                <br>
                                                <input  required class="form-control" name="app_name" type="text">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label >
                                                    Version
                                                </label>
                                                <br>
                                                <input  required class="form-control" name="version" type="text">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label >
                                                    App ID
                                                </label>
                                                <br>
                                                <input  required class="form-control" name="app_id" type="text">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label >
                                                    Link
                                                </label>
                                                <br>
                                                <input  required class="form-control" name="app_link" type="text">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12 ">
                                                <button class="btn btn-primary float-right" type="submit">Add App</button>
                                            </div>
                                        </div>
                                    </div>

                            </form>


                    </div>
                </div>
            </div>

            <script>
                $(document).ready(function(){
                    $('.dataTables-example').DataTable({
                        pageLength: 25,
                        responsive: true,
                        dom: '<"html5buttons"B>lTfgitp',
                        buttons: [
                            { extend: 'copy'},
                            {extend: 'csv'},
                            {extend: 'excel', title: 'ExampleFile'},
                            {extend: 'pdf', title: 'ExampleFile'},

                            {extend: 'print',
                                customize: function (win){
                                    $(win.document.body).addClass('white-bg');
                                    $(win.document.body).css('font-size', '10px');

                                    $(win.document.body).find('table')
                                        .addClass('compact')
                                        .css('font-size', 'inherit');
                                }
                            }
                        ]

                    });

                });

            </script>

        </div>
    </div>
@endsection

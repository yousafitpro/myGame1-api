@extends('layouts.dashboard')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Gamers</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
{{--                    <a href="{{route('admin.user.add')}}">  <button class="btn btn-primary float-right"> Add New</button></a>--}}
                </div>
            </div>
            <br>
            <div class="table-responsive">
                <table class="table  table-bordered table-hover dataTables-example" >
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($users as $user)
                        <tr class="center">
                            <td>{{$user->user->fname." ".$user->lname}}</td>
                            <td>{{$user->user->email}}</td>
                            <td>{{$user->user->phone}}</td>
                            @if($user->user->status=='1')<td>Active</td>@endif
                            @if($user->user->status=='0')<td>Not-Active</td>@endif
                            <td width="50px">
                                <div class="dropdown dropdown-menu-bottom">
                                    <i class="fa fa-cogs" data-toggle="dropdown"></i>

                                    <ul class="dropdown-menu">
                                        <li><a href="{{route('admin.user.gameusers.remove',[$user->user->id,$game_id])}}" >Remove</a></li>

                                    </ul>
                                </div>
                            </td>
                        </tr>
                        {{--            Delete Moel--}}
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </tfoot>
                </table>
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

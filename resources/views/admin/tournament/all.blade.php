@extends('layouts.dashboard')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3>All Tournaments</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{route('admin.tournament.add')}}">  <button class="btn btn-primary float-right"> Add New</button></a>
                </div>
            </div>
            <br>
    <div class="table-responsive">
        <table class="table  table-bordered table-hover dataTables-example" >
            <thead>
            <tr>
                <th>Name</th>
                <th>Game</th>
                <th>Status</th>
                <th>Start Date</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>

            @foreach($tournaments as $tournament)
            <tr class="center">
                <td>{{$tournament->name}}</td>
                <td>{{$tournament->game->name}}</td>
                @if($tournament->status=='1')
                    <td style="color: green; font-weight: bold">Started</td>
                @endif
                @if($tournament->status=='0')
                    <td style="color: red; font-weight: bold">Stoped</td>
                @endif
                @if($tournament->status=='2')
                    <td style="color:darkorange; font-weight: bold">Paused</td>
                @endif
                @if($tournament->status=='3')
                    <td style="color: black; font-weight: bold">Hiden</td>
                @endif
                @if($tournament->status=='4')
                    <td style="color: green; font-weight: bold">Completed</td>
                @endif
                <td>{{$tournament->start_date}}</td>

                <td width="50px">
                    <div class="dropdown dropdown-menu-bottom">
                        <i class="fa fa-cogs" data-toggle="dropdown"></i>

                        <ul class="dropdown-menu">
                            @if($tournament->status=='0' )
                                <li><a href="{{route('admin.tournament.start',$tournament->id)}}">Start</a></li>
                            @endif
                            @if($tournament->status=='1')
                                <li><a href="{{route('admin.tournament.pause',$tournament->id)}}">Pause</a></li>
                                    <li><a href="{{route('admin.tournament.stop',$tournament->id)}}">Stop</a></li>
                            @endif
                                @if($tournament->status=='2')
                                    <li><a href="{{route('admin.tournament.start',$tournament->id)}}">Resume</a></li>
                                    <li><a href="{{route('admin.tournament.stop',$tournament->id)}}">Stop</a></li>
                                @endif
                                <li><a href="{{route('admin.tournament.pause',$tournament->id)}}">Show</a></li>
                                <li><a href="{{route('admin.tournament.hide',$tournament->id)}}">Hide</a></li>
                                <li><a href="{{route('admin.tournament.getOne',$tournament->id)}}">Edit/View</a></li>
                                <li><a href="{{route('admin.leaderboard.show',$tournament->id)}}" >Leaderboard</a></li>
                                <li><a href="{{route('admin.tournament.requests',$tournament->id)}}">Requests</a></li>

                                <li><a href="#" data-toggle="modal" data-target="#deleteModel">Delete</a></li>

                        </ul>
                    </div>
                </td>
            </tr>
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
                           <a href="{{route('admin.tournament.deleteOne',$tournament->id)}}"> <button type="button" class="btn btn-primary">Yes</button></a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <th>Name</th>
                <th>Game</th>
                <th>Status</th>
                <th>Start Date</th>

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

@extends('layouts.dashboard')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3>All Games</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{route('admin.game.add')}}">  <button class="btn btn-primary float-right"> Add New</button></a>
                </div>
            </div>
            <br>
    <div class="table-responsive">
        <table class="table  table-bordered table-hover dataTables-example" >
            <thead>
            <tr>
                <th>Game ID (Key)</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>

            @foreach($games as $game)
            <tr class="center">
                <td>{{$game->id}}</td>
                <td>{{$game->name}}</td>
                <td width="50px">
                    <div class="dropdown dropdown-menu-bottom">
                        <i class="fa fa-cogs" data-toggle="dropdown"></i>

                        <ul class="dropdown-menu">
{{--                            <li><a href="{{route('admin.user.gameusers.getAllListed',$game->id)}}">All Gamers</a></li>--}}

{{--                            <li><a href="{{route('admin.user.gameusers.getAllGamers',$game->id)}}">Add New Gamer</a></li>--}}

                        @if(Auth::user()->type=='supper-admin')
                            <li><a href="#" data-toggle="modal" data-target="#deleteModel">Delete</a></li>
                            @endif
                                <li><a href="{{route('admin.leaderboard.show',$game->id)}}" >Leaderboard</a></li>
                            @if(Auth::user()->type=='supper-admin')
                            <li><a href="{{route('admin.game.getOne',$game->id)}}">Edit/View</a></li>
                       @endif
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
                           <a href="{{route('admin.game.deleteOne',$game->id)}}"> <button type="button" class="btn btn-primary">Yes</button></a>
                        </div>
                    </div>
                </div>
            </div>

            @endforeach

            </tbody>
            <tfoot>
            <tr>
                <th>Game ID (Key)</th>
                <th>Name</th>

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

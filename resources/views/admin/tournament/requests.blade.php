@extends('layouts.dashboard')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3>All Requests</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{route('admin.tournament.getAll')}}">  <button class="btn btn-primary "> Go Back</button></a>
                    <a class="ml-2" href="{{route('admin.tournament.requests',$id)}}">  <button class="btn btn-primary ">All Requests</button></a>
                    <a class="ml-2" href="{{route('admin.tournament.requests',$id).'?rejected=1'}}">  <button class="btn btn-primary "> Rejected Requests</button></a>
                    <a class="ml-2" href="{{route('admin.tournament.requests',$id).'?approved=1'}}">  <button class="btn btn-primary ">Approved Requests</button></a>

                </div>
            </div>
            <br>
    <div class="table-responsive">
        <table class="table  table-bordered table-hover dataTables-example" >
            <thead>
            <tr>
                <th>User</th>
                <th>Payment ID</th>
                <th>Payment Method</th>
                <th>Recieved Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>

            @foreach($list as $item)
            <tr class="center">
                <td>{{$item->user->fname." ".$item->user->lname}}
                    <br> <label style="color: darkred; font-weight: bold">Email:{{$item->user->email}}</label>
                    <br> <label style="color:darkgoldenrod; font-weight: bold">Phone:{{$item->user->phone}}</label>
                </td>
                <td>{{$item->payment_id}}</td>
                <td>{{$item->paymentmethod_id}}</td>
                <td>{{\Carbon\Carbon::parse($item->created_at)->diffForHumans()}}<br>({{$item->created_at}})</td>
                <td>
                    @if($item->status=='1')
                        <label style="font-weight: bold; color: green">Approved</label>
                        @endif
                        @if($item->status=='0')
                            <label style="font-weight: bold; color:red">Rejected</label>
                        @endif
                        @if($item->status=='2')
                            <label style="font-weight: bold; color: yellowgreen">Pending</label>
                        @endif
                </td>
                <td width="50px">
                    <div class="dropdown dropdown-menu-bottom">
                        <i class="fa fa-cogs" data-toggle="dropdown"></i>

                        <ul class="dropdown-menu">

                                <li><a href="{{route('admin.tournament.request.approve',$item->id)}}">Approve</a></li>
                                <li><a href="{{route('admin.tournament.request.reject',$item->id)}}">Reject</a></li>

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
                           <a href="{{route('admin.tournament.deleteOne',$item->id)}}"> <button type="button" class="btn btn-primary">Yes</button></a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <th>User</th>
                <th>Payment ID</th>
                <th>Payment Method</th>
                <th>Recieved Date</th>
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

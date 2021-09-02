@extends('layouts.dashboard')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Withdrawl Requests</h3>
        </div>
        <div class="card-body">
    <div class="table-responsive">
        <table class="table  table-bordered table-hover dataTables-example" >
            <thead>
            <tr>
                <th>ID</th>
                <th>user</th>
                <th>Wallet Amount</th>
                <th>Requested Amount</th>
                <th>Created At</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>

            @foreach($requests as $request)
            <tr class="center">
                <td>{{$request->id}}</td>
                <td>Email: {{$request->user->email}}<br>Phone: {{$request->user->phone}}</td>
                <td>{{$request->wallet_amount}}</td>
                <td>{{$request->amount}}</td>
                <td>{{$request->created_at}}</td>
                <td>{{$request->status}}</td>

                <td width="50px">
                    <div class="dropdown dropdown-menu-bottom">
                        <i class="fa fa-cogs" data-toggle="dropdown"></i>

                        <ul class="dropdown-menu">

                            <li  data-toggle="modal" data-target="#approveModel{{$request->id}}" ><a href="#">Approve</a></li>
                            <li data-toggle="modal" data-target="#rejectModel{{$request->id}}"><a href="#" >Reject</a></li>
                        </ul>
                    </div>
                </td>
            </tr>
{{--            Approve Modal--}}
            <div class="modal fade" id="approveModel{{$request->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Add a Note</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                         <form action="{{route('admin.withdrawalRequest.approve',$request->id)}}" method="get">
                             @csrf
                             <textarea class="form-control" style="height: 100px;" name="note"></textarea>
                         <br>
                             <button type="submit" class="btn btn-primary">Approve</button>
                         </form>
                        </div>

                    </div>
                </div>
            </div>

            {{--            Approve Modal--}}
            <div class="modal fade" id="rejectModel{{$request->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Add a Note</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('admin.withdrawalRequest.reject',$request->id)}}" method="get">
                                @csrf
                                <textarea class="form-control" style="height: 100px;" name="note"></textarea>
                                <br>
                                <button type="submit" class="btn btn-primary">Reject</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <th>ID</th>
                <th>user</th>
                <th>Wallet Amount</th>
                <th>Requested Amount</th>
                <th>Created At</th>
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

@extends('layouts.dashboard')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Payment Methods</h3>
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
                <th>Title</th>
                <th>Account Name</th>
                <th>Account User Name</th>
                <th>Account Mobile</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>

            @foreach($list as $item)
            <tr class="center">
                <td>{{$item->title}}</td>
                <td>{{$item->account_holder_name}}</td>
                <td>{{$item->account_user_name}}</td>
                <td>{{$item->account_mobile}}</td>
                <td>
                    @if($item->status=='1')
                        <label style="font-weight: bold;color: green">Active</label>
                    @endif
                        @if($item->status=='0')
                            <label style="font-weight: bold;color: red">Unactive</label>
                        @endif
                </td>
                <td width="50px">
                    <div class="dropdown dropdown-menu-bottom">
                        <i class="fa fa-cogs" data-toggle="dropdown"></i>

                        <ul class="dropdown-menu">
                            @if($item->status=='0')
                                <li><a href="{{route('admin.paymentMethods.active',$item->id)}}" >Active</a></li>
                            @endif
                                @if($item->status=='1')
                            <li><a href="{{route('admin.paymentMethods.unactive',$item->id)}}">Unactive</a></li>
                                @endif
                            <li><a href="#" data-toggle="modal" data-target="#updateModel{{$item->id}}">Edit/View</a></li>
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
                           <a href="{{route('admin.role.deleteOne',$item->id)}}"> <button type="button" class="btn btn-primary">Yes</button></a>
                        </div>
                    </div>
                </div>
            </div>
            {{--            update Moel--}}
            <div class="modal fade" id="updateModel{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Add New Payment Method</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="{{route('admin.paymentMethods.update',$item->id)}}">
                                @csrf
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h3>Title:</h3>
                                            <input name="title" required value="{{$item->title}}"  class="form-control">
                                            <h3>Private Key:</h3>
                                            <input name="private_key" value="{{$item->private_key}}" required   class="form-control">
                                            <h3>Public key:</h3>
                                            <input name="public_key" value="{{$item->public_key}}" required   class="form-control">
                                            <h3>API key:</h3>
                                            <input name="api_key" value="{{$item->api_key}}" required   class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <h3>Account Holder Name:</h3>
                                            <input name="account_holder_name" value="{{$item->account_holder_name}}" required   class="form-control">
                                            <h3>Account User Name:</h3>
                                            <input name="account_user_name" value="{{$item->account_user_name}}" required   class="form-control">
                                            <h3>Account Mobile:</h3>
                                            <input name="account_mobile" value="{{$item->account_mobile}}" required  class="form-control">
                                            <h3>Account ID:</h3>
                                            <input name="account_id" value="{{$item->account_id}}" required  class="form-control">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h3>Status:</h3>
                                            <select name="status" required>
                                                <option value="1">Active</option>
                                                <option value="0">Unactive</option>
                                            </select>

                                        </div>
                                        <div class="col-md-6">

                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-md-8 offset-2">
                                            <button type="submit" class="btn btn-primary form-control">Submit</button>
                                        </div>

                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

            </div>

            @endforeach

            </tbody>
            <tfoot>
            <tr>
                <th>Title</th>
                <th>Account Name</th>
                <th>Account User Name</th>
                <th>Account Mobile</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            </tfoot>
        </table>
        {{--            add Moel--}}
        <div class="modal fade" id="addModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Add New Payment Method</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                  <form method="post" action="{{route('admin.paymentMethods.add')}}">
                      @csrf
                      <div class="container-fluid">
                          <div class="row">
                              <div class="col-md-6">
                                  <h3>Title:</h3>
                                  <input name="title" required   class="form-control">
                                  <h3>Private Key:</h3>
                                  <input name="private_key" value="N/A" required   class="form-control">
                                  <h3>Public key:</h3>
                                  <input name="public_key" value="N/A" required   class="form-control">
                                  <h3>API key:</h3>
                                  <input name="api_key" value="N/A" required   class="form-control">
                              </div>
                              <div class="col-md-6">
                                  <h3>Account Holder Name:</h3>
                                  <input name="account_holder_name" value="N/A" required   class="form-control">
                                  <h3>Account User Name:</h3>
                                  <input name="account_user_name" value="N/A" required   class="form-control">
                                  <h3>Account Mobile:</h3>
                                  <input name="account_mobile" value="N/A" required  class="form-control">
                                  <h3>Account ID:</h3>
                                  <input name="account_id" value="N/A" required  class="form-control">
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-md-6">
                                  <h3>Status:</h3>
                                  <select name="status" required>
                                      <option value="1">Active</option>
                                      <option value="0">Unactive</option>
                                  </select>

                              </div>
                              <div class="col-md-6">

                              </div>
                          </div><br>
                          <div class="row">
                              <div class="col-md-8 offset-2">
                                  <button type="submit" class="btn btn-primary form-control">Submit</button>
                              </div>

                          </div>
                      </div>
                  </form>

                </div>
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

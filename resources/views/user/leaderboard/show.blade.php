@extends('layouts.dashboard')
@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-8">
               <div class="card">
                   <div class="card-header">
                       <i class="fa fa-users fa-5x"></i> <span style="font-size: 30px">Players</span>
                   </div>
                   <div class="card-body">
                       <table class="table  table-bordered table-hover dataTables-only" >
                           <thead>
                           <tr>
                               <th>#</th>
                               <th>Name</th>
                               <th>Email</th>
                               <th>Time Taken</th>

                               {{--                        <th>Actions</th>--}}
                           </tr>
                           </thead>
                           <tbody>

                           @foreach($users as $user)

                                  <tr class="center">
                                      <td>{{$loop->index+1}}</td>
                                      <td>{{$user->user->fname." ".$user->user->lname}}</td>
                                      <td>{{$user->user->email}}</td>
                                      <td>{{$user->time}}</td>

                                  </tr>


                           @endforeach
                           </tbody>
                           <tfoot>
                           <tr>
                               <th>Position</th>
                               <th>Name</th>
                               <th>Email</th>
                               <th>Time Taken</th>
                           </tr>
                           </tfoot>
                       </table>
                   </div>
               </div>
                <br>
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-trophy fa-5x"></i> <span style="font-size: 30px">Winners</span>
                    </div>
                    <div class="card-body">
                        <table class="table  table-bordered table-hover dataTables-only" >
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Time Taken</th>

                                {{--                        <th>Actions</th>--}}
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($winners as $user)
                                @if($loop->index<3)
                                <tr class="center">
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{$user->user->fname." ".$user->user->lname}}</td>
                                    <td>{{$user->user->email}}</td>
                                    <td>{{$user->time}}</td>

                                </tr>
                                @endif
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Position</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Time Taken</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-center" style="">
                        <div style="width: 50px; height: 50px;  " class="">
                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="crown" class="svg-inline--fa fa-crown fa-w-20" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path fill="currentColor" d="M528 448H112c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h416c8.8 0 16-7.2 16-16v-32c0-8.8-7.2-16-16-16zm64-320c-26.5 0-48 21.5-48 48 0 7.1 1.6 13.7 4.4 19.8L476 239.2c-15.4 9.2-35.3 4-44.2-11.6L350.3 85C361 76.2 368 63 368 48c0-26.5-21.5-48-48-48s-48 21.5-48 48c0 15 7 28.2 17.7 37l-81.5 142.6c-8.9 15.6-28.9 20.8-44.2 11.6l-72.3-43.4c2.7-6 4.4-12.7 4.4-19.8 0-26.5-21.5-48-48-48S0 149.5 0 176s21.5 48 48 48c2.6 0 5.2-.4 7.7-.8L128 416h384l72.3-192.8c2.5.4 5.1.8 7.7.8 26.5 0 48-21.5 48-48s-21.5-48-48-48z"></path></svg>
                        </div>
                    </div>
                    <div class="card-body">
                        <br>

                            <div style="width: 100%" class="d-flex align-items-center justify-content-center">
                                <span style="font-size: 20px">Amount:</span><label style="font-size: 15px; margin-left: 10px">{{$tournament->collected_amount}}</label>

                            </div>


                    </div>
                </div>
                <br>
                @if(Auth::user()->type=='supper-admin')
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <form action="{{route('admin.leaderboard.updateAmount',$game_id)}}" method="post">
                          @csrf
                            <div class="col-md-12">
                                <br>
                                <label>Amount</label>
                                <input class="form-control" value="{{$tournament->collected_amount}}" min="0" name="amount">
                                <br>
                                <button  type="submit" class="form-control btn btn-primary" >Save</button>
                            </div>
                        </form>
                        <form action="{{route('admin.leaderboard.distributeAmount',$tournament->id)}}" method="post">
                            @csrf
                            <div class="col-md-12">
                                <br>
                                @if($tournament->status!='4')
                                <button  type="submit" class="form-control btn btn-primary" >Distribute Amount</button>
                                @endif
                            </div>
                        </form>


                    </div>
                </div>
            </div>
                    @endif
            </div>
        </div>
    </div>
@endsection

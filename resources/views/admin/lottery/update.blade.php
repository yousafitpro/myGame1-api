@extends('layouts.dashboard')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <form action="{{route('admin.lottery.update',$lottery->id)}}" method="post">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h3>Update lottery</h3>
                        </div>
                        <div class="card-body">
                            @include('errorBars.errorsArray',['title' => 'Error','errors'=>$errors])
                            <div class="row">
                                <div class="col-md-4">
                                    <label >
                                        Admin %
                                    </label>
                                    <br>
                                </div>
                                <div class="col-md-4">
                                    <label >
                                        Win 1 %
                                    </label>
                                    <br>
                                </div>
                                <div class="col-md-4">
                                    <label >
                                        Win 2 %
                                    </label>
                                    <br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <input  required class="form-control" name="admin" type="number" value="{{$lottery->admin}}">
                                </div>
                                <div class="col-md-4">
                                    <input  required class="form-control" name="win1" type="number" value="{{$lottery->win1}}">
                                </div>
                                <div class="col-md-4">
                                    <input  required class="form-control" name="win2" type="number" value="{{$lottery->win2}}">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4">
                                    <label >
                                        Win 3 %
                                    </label>
                                    <br>
                                </div>
                                <div class="col-md-4">
                                    <label >
                                        Win 4 %
                                    </label>
                                    <br>
                                </div>
                                <div class="col-md-4">
                                    <label >
                                        Win 5 %
                                    </label>
                                    <br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <input  required class="form-control" name="win3" type="number" value="{{$lottery->win3}}">
                                </div>
                                <div class="col-md-4">
                                    <input  required class="form-control" name="win4" type="number" value="{{$lottery->win4}}">
                                </div>
                                <div class="col-md-4">
                                    <input  required class="form-control" name="win5" type="number" value="{{$lottery->win5}}">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4">
                                    <label >
                                        Sec Win's %
                                    </label>
                                    <br>
                                </div>
                                <div class="col-md-4">
                                    <label >
                                        Sec Win Count
                                    </label>
                                    <br>
                                </div>
                                <div class="col-md-4">
                                    <label >
                                        Sec Win's Max Amt
                                    </label>
                                    <br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <input  required class="form-control" name="sec_win" type="number" value="{{$lottery->sec_win}}">
                                </div>
                                <div class="col-md-4">
                                    <input  required class="form-control" name="sec_win_count" type="number" value="{{$lottery->sec_win_count}}">
                                </div>
                                <div class="col-md-4">
                                    <input  required class="form-control" name="sec_win_max_amt" type="number" value="{{$lottery->sec_win_max_amt}}">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <label >
                                        Minimum Withdraw Amount
                                    </label>
                                    <br>
                                </div>
                                <div class="col-md-6">
                                    <label >
                                       Tournament
                                    </label>
                                    <br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <input  required class="form-control" name="min_withdraw_amt" type="number" value="{{$lottery->min_withdraw_amt}}">
                                </div>
                                <div class="col-md-6">
                                    <select name="tournament_id" class="form-control">
                                        <option value="{{$lottery->tournament->id}}">{{$lottery->tournament->name}}</option>
                                        @foreach($tournaments as $t)
                                            <option value="{{$t->id}}">{{$t->name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <br>

                            <br>
                            <div class="row">
                                <div class="col-md-12 ">
                                    <button class="btn btn-primary float-right" type="submit">Update Lottery</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
@endsection

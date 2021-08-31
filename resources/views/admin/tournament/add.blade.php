@extends('layouts.dashboard')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
    <form action="{{route('admin.tournament.add')}}" method="post">
        @csrf
        <div class="card">
            <div class="card-header">
                <h3>Add Tournament</h3>
            </div>
            <div class="card-body">
                @include('errorBars.errorsArray',['title' => 'Error','errors'=>$errors])
<div class="row">


                    <div class="col-md-4">
                        <label >
                            Name
                        </label>
                        <br>
                        <input  required class="form-control" value="{{old('name')}}" name="name">
                    </div>
    <div class="col-md-4">
        <label >
            Game
        </label>
        <br>
        <select name="game_id" class="form-control">
            @foreach($games as $game)
                <option value="{{$game->id}}">{{$game->name}}</option>
            @endforeach

        </select>
    </div>
    <div class="col-md-4">
        <label >
            Start Date
        </label>
        <br>
        <input  required class="form-control" value="{{old('start_date')}}" name="start_date" type="date">
    </div>
</div>
                <br>
                <div class="row">


                    <div class="col-md-4">
                        <label >
                            Collected Amount
                        </label>
                        <br>
                        <input  required class="form-control" value="{{old('collected_amount')}}" name="collected_amount" type="number">
                    </div>
                    <div class="col-md-4">
                        <label >
                            Duration (Days)
                        </label>
                        <br>
                        <input  required class="form-control" value="{{old('duration')}}" name="duration" type="number">
                    </div>
                    <div class="col-md-4">
                        <label >
                            Admin Percentage
                        </label>
                        <br>
                        <input  required class="form-control" value="{{old('admin_percent')}}" name="admin_percent" type="number">

                    </div>
                </div>
<br>
                <div class="row">


                    <div class="col-md-4">
                        <label >
                            Winner 1
                        </label>
                        <br>
                        <input  required class="form-control" value="{{old('w1_percent')}}" name="w1_percent" type="number">
                    </div>
                    <div class="col-md-4">
                        <label >
                            Winner 2
                        </label>
                        <br>
                        <input  required class="form-control" value="{{old('w2_percent')}}" name="w2_percent" type="number">
                    </div>
                    <div class="col-md-4">
                        <label >
                            Winner 3
                        </label>
                        <br>
                        <input  required class="form-control" value="{{old('w3_percent')}}"  name="w3_percent" type="number">
                    </div>
                </div>
                <br>
                <div class="row">


                    <div class="col-md-4">
                        <label >
                            Entry Fee
                        </label>
                        <br>
                        <input  required class="form-control" value="{{old('admin_percent')}}" name="entry_fee" type="number">

                    </div>
                </div>
                <br>
                <div class="row">



                    <div class="col-md-12 ">
                        <button class="btn btn-primary form-control" type="submit">Add</button>
                    </div>
                </div>


            </div>
        </div>
    </form>
</div>
            <div class="col-md-1"></div>
        </div>
    </div>
@endsection

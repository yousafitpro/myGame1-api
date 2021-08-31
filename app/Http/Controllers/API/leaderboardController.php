<?php
//test
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\gameuser;
use App\Models\listeduser;
use App\Models\tournament;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class leaderboardController extends Controller
{
    public function send_time(Request $request)
    {
        if(!tournament::where('id',$request->tournament_id)->exists())
        {
            return response()->json(['message'=>"Tournament is not Created yet for this ID"],200);
        }
//        if(!gameuser::where("user_id",auth('api')->user()->id)->where('game_id',$request->game_id)->exists())
//        {
//            return response()->json(['message'=>"Sorry! You are not the part of this Tournament"],409);
//        }
          $obj=new listeduser();
          $obj->time=$request->time;
          $obj->tournament_id=$request->game_id;
          $obj->save();
          return response()->json(['message'=>"Time Successfully Saved"],200);

    }

    public function leaderboard(Request $request)
    {
        //ssdasd
        if(!tournament::where('id',$request->tournament_id)->exists())
        {
            return response()->json(['message'=>"Tournament is not Created yet for this ID"],200);
        }
        $t=tournament::where('id',$request->tournament_id)->first();
        $endDate=Carbon::parse($t->start_date)->addDays($t->duration);
        $users=listeduser::where('tournament_id',$request->tournament_id)->orderBy('time','ASC')->with('user')->get();
        $winners=listeduser::where('tournament_id',$request->tournament_id)->orderBy('time','ASC')->with('user')->get();
        $winners=$winners->unique('user_id');
        return response()->json(['users'=>$users,'game_id'=>$request->game_id,'tournament'=>$t,'endDate'=>$endDate,'winners'=>$winners],200);

    }
}

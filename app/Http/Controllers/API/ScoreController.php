<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\listeduser;
use App\Models\score;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function score_by_game_id(Request $request)
    {
        $users=listeduser::where('game_id',$request->game_id)->where('user_id',$request->game_id)->orderBy('time','ASC')->with('user')->get();

        foreach($users->unique('user_id') as $user) {
            return response()->json($user->time,200);
        }

    }
    public function save_score(Request $request)
    {
        $score=new score();
        $score->game_id=$request->game_id;
        $score->score=$request->score;
        $score->save();
        return response()->json(['msg'=>"Score Successfully Updated"],200);
    }
}

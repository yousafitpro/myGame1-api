<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\game;
use App\Models\gameuser;
use App\Models\listeduser;
use App\Models\lottery;
use App\Models\role;
use App\Models\tournament;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class GameController extends Controller
{

    public function addView()
    {
        return view('admin.game.add');
    }
    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required|unique:roles',
        ]);

        if ($validator->fails())
        {
            return Redirect::route('admin.game.add')->withErrors($validator);
        }
        $game=new game();
        $game->name=$request->name;
        if($game->save())
        {
            Session::put('success-msg','Game Successfully Added');
        }
        return redirect()->back();
    }
    public function getOne($id)
    {
        $game=game::find($id);

        return view('admin.game.update')->with('game',$game);
    }
    public function deleteOne($id)
    {
        $game=game::find($id);
        if(tournament::where('game_id',$game->id)->exists())
        {

            $t=tournament::where('game_id',$game->id)->first();
            $t->delete();
            if(lottery::where('tournament_id',$t->id)->exists())
            {
                $l=lottery::where('tournament_id',$t->id)->first();
                $l->delete();
            }
        }

        if(gameuser::where('game_id',$game->id))
        {
            $gu=gameuser::where('game_id',$game->id);
            $gu->delete();
        }
        if(listeduser::where('game_id',$game->id))
        {
            $lu=listeduser::where('game_id',$game->id);
            $lu->delete();
        }

        if($game->delete())
        {




            Session::put('success-msg',"Game Successfully Deleted");
        }
        return redirect(route('admin.game.getAll'));
    }
    public function update(Request $request,$id)
    {

        $game=game::find($id);
        $game->id=$request->id;
        $game->name=$request->name;
        if($game->save())
        {
            Session::put('success-msg',"Game Successfully Updated");
        }
        return redirect(route('admin.game.getAll'));
    }
    public function getAll()
    {
//        $games=game::where('user_id',Auth::user()->id)->with('user')->get();
        $games=game::with('user')->get();
        $users=User::where('type',"!=","supper-admin")->get();
        return view('admin.game.all')->with(['games'=>$games,'users'=>$users]);
    }


}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\gameuser;
use App\Models\listeduser;
use App\Models\lottery;
use App\Models\tournament;
use App\Models\tournamentuser;
use App\Models\wallet_amount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class leaderboardController extends Controller
{

    public function leaderboard($id)
    {
      if(!tournament::where('id',$id)->exists())
      {
          Session::put('error-msg',"This Game has no tournament.");
          return \redirect()->back();
      }
        $t=tournament::where('id',$id)->first();
        $users=listeduser::where('tournament_id',$id)->orderBy('time','ASC')->with('user')->get();

        $winners=listeduser::where('tournament_id',$id)->orderBy('time','ASC')->with('user')->get();
        $winners=$winners->unique('user_id');

        return view('user.leaderboard.show')->with(['users'=>$users,'game_id'=>$id,'tournament'=>$t,'winners'=>$winners]);
    }
    public function updateAmount(Request $request,$id)
    {
        $t=tournament::where('id',$id)->first();
        $t->collected_amount=$request->amount;
        $t->save();
        Session::put('success-msg',"Amount Successfully Updated");
     return \redirect(route('admin.leaderboard.show',$id));
    }
    public function distributeAmount($id)
    {     $t=tournament::find($id);

          $amount=$t->collected_amount;


          $users=listeduser::where('tournament_id',$t->id)->orderBy('time','ASC')->with('user')->get();
          $i=1;
          $k=0;
        foreach($users->unique('user_id') as $user) {

        $k++;
        }
        if($k<3)
        {
            Session::put("error-msg","You must have the 3 players to Distribute the Amount");
            return \redirect()->back();
        }
        $uAmount=($t->collected_amount/100)*$t->admin_percent;
        self::wallet_amount('1',$uAmount);
        foreach($users->unique('user_id') as $user){
        if($i==1)
        {
           $uAmount=($t->collected_amount/100)*$t->w1_percent;
            self::wallet_amount($user->user_id,$uAmount);
        }
            else if($i==2)
            {
                $uAmount=($t->collected_amount/100)*$t->w2_percent;
                self::wallet_amount($user->user_id,$uAmount);
            }
            else if($i==3)
            {
                $uAmount=($t->collected_amount/100)*$t->w3_percent;
                self::wallet_amount($user->user_id,$uAmount);
            }

        $i++;
}
//        $listedUsers=listeduser::where('game_id',$t->game_id)->delete();
//
//        $gamers=gameuser::where('game_id',$t->game_id)->delete();
           $t->status='4';
        $t->save();
        Session::put("success-msg","Amount Distributed Successfully");
        return redirect(route('admin.game.getAll'));
    }
    public function wallet_amount($user_id,$amount)
    {
        $wa=new wallet_amount();
        $wa->user_id=$user_id;
        $wa->amount=$amount;
        $wa->save();
    }
    public function wallet_amounts()
    {
        $payments=wallet_amount::where('user_id',Auth::user()->id)->get();
        $total=wallet_amount::where('user_id',Auth::user()->id)->get()->sum('amount');
        return view('user.walletAmounts')->with(['payments'=>$payments,'total'=>$total]);
    }
}

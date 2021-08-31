<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\gameuser;
use App\Models\listeduser;
use App\Models\lottery;
use App\Models\tournament;
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
      if(!tournament::where('game_id',$id)->exists())
      {
          Session::put('error-msg',"This Game has no tournament.");
          return \redirect()->back();
      }
        $t=tournament::where('game_id',$id)->first();
        $users=listeduser::where('game_id',$id)->orderBy('time','ASC')->with('user')->get();

        return view('user.leaderboard.show')->with(['users'=>$users,'game_id'=>$id,'tournament'=>$t]);
    }
    public function updateAmount(Request $request,$id)
    {
        $t=tournament::where('game_id',$id)->first();
        $t->collected_amount=$request->amount;
        $t->save();
        Session::put('success-msg',"Amount Successfully Updated");
     return \redirect(route('admin.leaderboard.show',$id));
    }
    public function distributeAmount($id)
    {     $t=tournament::find($id);
         $l=lottery::where('tournament_id',$id)->first();
          $remaing_amout=$t->collected_amount;


         $amount=($remaing_amout/100)*$l->admin;
         $remaing_amout=$remaing_amout-$amount;
          self::wallet_amount($t->user_id,$amount);


          $users=listeduser::where('game_id',$t->game_id)->orderBy('time','ASC')->with('user')->get();
          $i=1;
          $k=0;
        foreach($users->unique('user_id') as $user) {

        $k++;
        }
        if($k<6)
        {
            Session::put("error-msg","You must have the 6 players to Distribute the Amount");
            return \redirect()->back();
        }

        foreach($users->unique('user_id') as $user){
        if($i==1)
        {
            $amount=($remaing_amout/100)*$l->win1;
            $remaing_amout=$remaing_amout-$amount;
            self::wallet_amount($user->user_id,$amount);
        }
            else if($i==2)
            {
                $amount=($remaing_amout/100)*$l->win2;
                $remaing_amout=$remaing_amout-$amount;
                self::wallet_amount($user->user_id,$amount);
            }
            else if($i==3)
            {
                $amount=($remaing_amout/100)*$l->win3;
                $remaing_amout=$remaing_amout-$amount;
                self::wallet_amount($user->user_id,$amount);
            }
            else if($i==4)
            {
                $amount=($remaing_amout/100)*$l->win4;
                $remaing_amout=$remaing_amout-$amount;
                self::wallet_amount($user->user_id,$amount);
            }
            else if($i==5)
            {
                $amount=($remaing_amout/100)*$l->win5;
                $remaing_amout=$remaing_amout-$amount;
                self::wallet_amount($user->user_id,$amount);
            }
            else
            {
               if ($i>$user->sec_win_count)
               {

                   ($remaing_amout>0);
                   {

                       self::wallet_amount($t->user_id,$remaing_amout);
                       $remaing_amout=$remaing_amout-$remaing_amout;
                       $listedUsers=listeduser::where('game_id',$t->game_id)->delete();

                       $gamers=gameuser::where('game_id',$t->game_id)->delete();

                       return \redirect(route('admin.game.getAll'));
                   }

               }
               else
               {
                   $amount=($remaing_amout/100)*$l->sec_win;
                   $remaing_amout=$remaing_amout-$amount;
                   self::wallet_amount($user->user_id,$amount);

               }

            }
        $i++;
}
        $listedUsers=listeduser::where('game_id',$t->game_id)->delete();

        $gamers=gameuser::where('game_id',$t->game_id)->delete();

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

<?php

namespace App\Http\Controllers\Admin;

use App\Models\game;
use App\Models\gameuser;
use App\Models\listeduser;
use App\Models\lottery;
use App\Models\tournament;
use App\Models\tournamentrequest;
use App\Models\tournamentuser;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;

class TournamentController extends Controller
{
    public function addView()
    {
        $games=game::where('user_id',Auth::user()->id)->get();
        return view('admin.tournament.add')->with('games',$games);
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required',
            'duration'=>'required',
            'collected_amount'=>'required',
            'game_id'=>'required|exists:games,id',
            'start_date'=>'required|after_or_equal:now',

        ]);

        if ($validator->fails())
        {
            return Redirect::route('admin.tournament.add')->withErrors($validator)->withInput();
        }
        $total=$request->admin_percent+$request->w1_percent+$request->w2_percent+$request->w3_percent;
       if($total!=100)
       {
           Session::put('error-msg',"Total of All Percentages must be equal to 100");
           return redirect()->back()->withInput();
       }
        $tournament=new tournament();
        $tournament->name=$request->name;
        $tournament->duration=$request->duration;
        $tournament->game_id=$request->game_id;
        $tournament->collected_amount=$request->collected_amount;
        $tournament->start_date=$request->start_date;
        $tournament->admin_percent=$request->admin_percent;
        $tournament->w1_percent=$request->w1_percent;
        $tournament->w2_percent=$request->w2_percent;
        $tournament->w3_percent=$request->w3_percent;
        $tournament->entry_fee=$request->entry_fee;
        $tournament->total_users=$request->total_users;
        if($tournament->save())
        {
            Session::put('success-msg','Tournament Successfully Added');
        }
        return redirect(route('admin.tournament.getAll'));
    }
    public function getOne($id)
    {
        $games=game::where('user_id',Auth::user()->id)->get();
        $tournament=tournament::where('id',$id)->with('game')->first();
        return view('admin.tournament.update')->with(['tournament'=>$tournament,'games'=>$games]);
    }
    public function deleteOne($id)
    {
        $tournament=tournament::find($id);
        if(lottery::where('tournament_id',$tournament->id)->exists())
        {
            $l=lottery::where('tournament_id',$tournament->id)->first();
            $l->delete();
        }
        if(game::where('id',$tournament->game_id)->exists())
        {
            $g=game::where('id',$tournament->game_id)->first();
            $g->delete();
        }

        $gu=gameuser::where('game_id',$g->id);
        $lu=listeduser::where('game_id',$g->id);
        if($tournament->delete())
        {


            $gu->delete();
            $lu->delete();
            Session::put('success-msg',"Tournament Successfully Deleted");
        }
        return redirect(route('admin.tournament.getAll'));
    }
    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required',
            'duration'=>'required',
            'game_id'=>'required|exists:games,id',
            'start_date'=>'required|after_or_equal:now',
            'collected_amount'=>'required'
        ]);

        if ($validator->fails())
        {
            return Redirect::route('admin.tournament.add')->withErrors($validator)->withInput();
        }
        $total=$request->admin_percent+$request->w1_percent+$request->w2_percent+$request->w3_percent;
        if($total!=100)
        {
            Session::put('error-msg',"Total of All Percentages must be equal to 100");
            return redirect()->back()->withInput();
        }
        $tournament=tournament::find($id);
        $tournament->collected_amount=$request->collected_amount;
        $tournament->name=$request->name;
        $tournament->duration=$request->duration;
        $tournament->game_id=$request->game_id;
        $tournament->start_date=$request->start_date;
        $tournament->admin_percent=$request->admin_percent;
        $tournament->w1_percent=$request->w1_percent;
        $tournament->w2_percent=$request->w2_percent;
        $tournament->w3_percent=$request->w3_percent;
        $tournament->entry_fee=$request->entry_fee;
        $tournament->total_users=$request->total_users;
        if($tournament->save())
        {
            Session::put('success-msg',"Tournament Successfully Updated");
        }
        return redirect(route('admin.tournament.getAll'));
    }
    public function getAll()
    {
        $tournaments=tournament::where('user_id',Auth::user()->id)->with('user')->get();
        return view('admin.tournament.all')->with('tournaments',$tournaments);
    }
    public function requests(Request $request,$id)
    {
        $query  =tournamentrequest::with('user');
        if(isset($_GET['rejected']) && $_GET['rejected']=='1')
        {
            $query  =$query->where('status','0');
        }
        if(isset($_GET['approved']) && $_GET['approved']=='1')
        {
            $query  =$query->where('status','1');
        }
        $query=$query->with('pmethod')->get();
//dd($query);



        return view('admin.tournament.requests')->with(['list'=>$query,'id'=>$id]);
    }
    public function start(Request $request,$id)
    {
        $t=tournament::find($id);
        if(Carbon::parse($t->start_date)->format('Y M d')<Carbon::now()->format('Y M d'))
        {

            Session::put('error-msg',"Sorry You cannot start this before the Starting Date");

        }
        else
        {
            $t->status='1';
            if($t->save())
            {
                Session::put('success-msg',"Tournament Successfully Started");
            }
        }

        return \redirect(route('admin.tournament.getAll'));
    }

    public function pause(Request $request,$id)
    {
        $t=tournament::find($id);

            $t->status='2';
            if($t->save())
            {
                Session::put('success-msg',"Tournament Successfully Paused");
            }


        return \redirect(route('admin.tournament.getAll'));
    }
    public function stop(Request $request,$id)
    {
        $t=tournament::find($id);
        $t->status='0';
        if($t->save())
        {
            Session::put('success-msg',"Tournament Successfully Stoped");
        }
        return \redirect(route('admin.tournament.getAll'));
    }
    public function hide(Request $request,$id)
    {
        $t=tournament::find($id);
        $t->status='3';
        if($t->save())
        {
            Session::put('success-msg',"Tournament Successfully Stoped");
        }
        return \redirect(route('admin.tournament.getAll'));
    }
    public function requestReject(Request $request,$id)
    {

     $r=tournamentrequest::find($id);
        tournamentuser::where('user_id',$r->user_id)->where('tournament_id',$r->tournament_id)->delete();
     $r->status='0';
     if($r->save())
     {
         Session::put('success-msg',"Request Successfully Rejected");
     }
        return \redirect()->back();
    }
    public function requestApprove(Request $request,$id)
    {
        $r=tournamentrequest::find($id);
        $r->status='1';
        $tu=new tournamentuser();
        $tu->user_id=$r->user_id;
        $tu->tournament_id=$r->tournament_id;
        if($r->save())
        {
            if(!tournamentuser::where('user_id',$r->user_id)->where('tournament_id',$r->tournament_id)->exists())
            {
                $tu->save();
            }
            Session::put('success-msg',"Request Successfully Approved");
        }
        return \redirect()->back();
    }
}

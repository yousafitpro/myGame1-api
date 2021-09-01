<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\appConfig;
use App\Models\game;
use App\Models\listeduser;
use App\Models\paymentMethod;
use App\Models\score;
use App\Models\tournament;
use App\Models\tournamentrequest;
use App\Models\tournamentuser;
use Carbon\Carbon;
use Illuminate\Http\Request;


class gameController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api')->except(['tournaments','appupdateinfo','paymentmethods']);
    }
public function tournaments()
{
          $ts=tournament::where('status','!=','3')->get();
          foreach ($ts as $t)
          {
              $t->is_member=0;
              if(auth('api')->check())
              {

                 if(tournamentuser::where(['tournament_id'=>$t->id,'user_id'=>auth('api')->user()->id])->exists())
                 {
                     $t->is_member=1;
                 }
                  if(tournamentrequest::where(['tournament_id'=>$t->id,'user_id'=>auth('api')->user()->id,'status'=>'2'])->exists())
                  {
                      $t->is_member=2;
                  }
              }
              $t->members_count=tournamentuser::where(['tournament_id'=>$t->id])->get()->count();
              $t->enddate=Carbon::parse($t->start_date)->addDays($t->duration);
          }

          return response()->json(['tournaments'=>$ts]);
}
public function appupdateinfo($id)
{
    if(appConfig::where('app_id',$id)->exists())
    {
        $info=appConfig::where('app_id',$id)->get()->last();
        return response()->json(['appinfo'=>$info]);
    }
    else
    {
        return response()->json(['message'=>"This is ID Have No App"],409);
    }

}
public function paymentmethods()
{
   $list=paymentMethod::where('status','1')->get();
   return response()->json(['paymentmethods'=>$list]);
}
public function paymentrequest(Request $request,$id)
{
    if(tournamentrequest::where(['paymentmethod_id'=>$request->paymentmethod_id,'payment_id'=>$request->payment_id])->exists())
    {
        return  response()->json(['alert'=>'This Payment ID Already Used']);
    }

    if(tournamentrequest::where(['paymentmethod_id'=>$request->paymentmethod_id,'payment_id'=>$request->payment_id])->where(function ($q){
        $q->where('status','2');
        $q->orwhere('status','1');
    })->exists())
    {
        return  response()->json(['alert'=>'This Payment ID Already Used']);
    }
    if(tournamentrequest::where(['tournament_id'=>$id,'user_id'=>auth('api')->user()->id,'status'=>'2'])->exists())
    {
        return  response()->json(['alert'=>'Your Application is in Process']);
//        $r=tournamentrequest::where(['tournament_id'=>$id,'user_id'=>auth('api')->user()->id])->get()->last();
//        return  response()->json(['request'=>$r],409);
    }
    if(tournamentrequest::where(['tournament_id'=>$id,'user_id'=>auth('api')->user()->id,'status'=>'1'])->exists())
    {
        return  response()->json(['alert'=>'This Payment ID Already Used']);
//        $r=tournamentrequest::where(['tournament_id'=>$id,'user_id'=>auth('api')->user()->id])->get()->last();
//        return  response()->json(['request'=>$r],409);
    }
    $p=new tournamentrequest();
    $p->tournament_id=$id;
    $p->payment_id=$request->payment_id;
    $p->paymentmethod_id=$request->paymentmethod_id;
    $p->user_id=auth('api')->user()->id;
    if($p->save())
    {
        return response()->json(['message'=>'Payment ID successfully Saved ' ]);
    }
}
}

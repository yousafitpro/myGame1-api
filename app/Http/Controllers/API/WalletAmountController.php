<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\score;
use App\Models\wallet_amount;
use App\Models\withdrawalhistory;
use App\Models\withdrawalrequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WalletAmountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function set_wallet_amount(Request $request)
    {
        $score=new wallet_amount();
        $score->amount=$request->amount;
        $score->save();
        $total=wallet_amount::where("user_id",Auth::user()->id)->get()->sum('amount');
        return response()->json(['message'=>"Successfully Updated",'amount'=>$request->amount,'total_amount'=>$total],200);
    }
    public function get_wallet(Request $request)
    {
        $requests=wallet_amount::where('user_id',Auth::user()->id)->get();
        $ws=wallet_amount::where('user_id',Auth::user()->id)->get();

        $total=0;


        foreach ($requests as $w)
        {
            $w->status='0';
            if(withdrawalrequest::where('wallet_amount_id',$w->id)->exists())
            {
                $w->status='1';
                //ok
            }

        }
        foreach ($requests as $w)
        {
            if($w->status=='0')
            {

               $total=$total+$w->amount;
            }


        }
        return response()->json(['data'=>$requests,'total'=>$total],200);
    }
    public function withdrawl_request($wallet_amount_id)
    {

        if(!wallet_amount::find($wallet_amount_id))
        {

            return response()->json("There is No request with this ID",200);
        }
        if(withdrawalrequest::where('wallet_amount_id',$wallet_amount_id)->exists())
        {

            return response()->json("Request Already Successfully Sent.",200);
        }
//        if (withdrawalhistory::where('wallet_amount_id',$wallet_amount_id)->exists() && withdrawalhistory::where('wallet_amount_id',$wallet_amount_id)->where('status','Completed')->exists())
//        {
//
//            return response()->json("Request in Process",200);
//
//
//        }
        $r=wallet_amount::find($wallet_amount_id);
         $wr=new withdrawalrequest();
        $wr->user_id=Auth::user()->id;
        $wr->wallet_amount_id=$wallet_amount_id;

         $wr->amount=$r->amount;
         if($wr->save())
         {
             return response()->json("Request Successfully Sent.",200);
         }

    }
    public function withdrawl_requests()
    {

        $wr=withdrawalrequest::where('user_id',Auth::user()->id)->get();

            return response()->json(['data',$wr],200);


    }
    public function withdrawl_requests_histories()
    {

        $wr=withdrawalhistory::where('user_id',Auth::user()->id)->get();

        return response()->json(['data',$wr],200);


    }
}

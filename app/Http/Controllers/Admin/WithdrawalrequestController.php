<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\wallet_amount;
use App\Models\withdrawalhistory;
use App\Models\withdrawalrequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class WithdrawalrequestController extends Controller
{
    public function getAll()
    {
        $requests=withdrawalrequest::where('user_id','!=',Auth::user()->id)->with('user')->get();
        foreach ($requests as $r)
        {
            $r->wallet_amount=wallet_amount::where('user_id',$r->user_id)->get()->sum('amount');
        }
        return view('admin.withdrawalRequest.all')->with('requests',$requests);
    }
    public function Approve($id)
    {
        $r=withdrawalrequest::find($id);

        $nr=new withdrawalhistory();
        $wr=wallet_amount::find($r->wallet_amount_id);
        $nr->user_id=$r->user_id;
        $nr->status="Completed";
        $nr->wallet_amount_id=$r->wallet_amount_id;
        $nr->amount=$r->amount;
        if($nr->save())
        {
            $wr->delete();
            $r->delete();
            Session::put("success-msg","Request Successfully Approved");
        }

        return redirect(route('admin.withdrawalRequest.getAll'));
    }
    public function reject($id)
    {
        $r=withdrawalrequest::find($id);
        $nr=new withdrawalhistory();
        $nr->user_id=$r->user_id;
        $nr->status="Rejected";
        $nr->wallet_amount_id=$r->wallet_amount_id;
        $nr->amount=$r->amount;
        if($nr->save())
        {
            $r->delete();
            Session::put("success-msg","Request Successfully Approved");
        }

        return redirect(route('admin.withdrawalRequest.getAll'));
    }
}

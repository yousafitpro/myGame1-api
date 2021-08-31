<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\wallet_amount;
use App\Models\withdrawalhistory;
use App\Models\withdrawalrequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WithdrawalhistoryController extends Controller
{
    public function getAll()
    {
        $requests=withdrawalhistory::where('user_id','!=',Auth::user()->id)->with('user')->get();

        foreach ($requests as $r)
        {
            $r->wallet_amount=wallet_amount::where('user_id',$r->user_id)->get()->sum('amount');
        }

        return view('admin.withdrawalHistory.all')->with('requests',$requests);
    }
}

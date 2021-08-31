<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\withdrawalhistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WithdrawalhistoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function get_withdraw_history(Request $request)
    {
        $requests=withdrawalhistory::where('user_id',Auth::user()->id)->get();
        return response()->json(['data'=>$requests],200);
    }
}

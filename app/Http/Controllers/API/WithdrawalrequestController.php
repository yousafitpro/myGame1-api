<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\withdrawalhistory;
use App\Models\withdrawalrequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WithdrawalrequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function withdraw_request(Request $request)
    {
        $requests=withdrawalrequest::where('user_id',Auth::user()->id)->get();
        return response()->json(['data'=>$requests],200);
    }
}

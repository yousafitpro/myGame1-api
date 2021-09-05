<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\webconfig;
use Carbon\Carbon;
use Illuminate\Http\Request;


class generalController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
//        $this->middleware('auth:api')->except(['tournaments','appupdateinfo','paymentmethods']);
    }
public function updateProfile(Request $request)
{
    $user=User::find(auth('api')->user()->id);
    $user->fname=$request->fname;
    $user->lname=$request->lname;
    $user->phone=$request->phone;
    $user->address=$request->address;
    if($user->save())
    {
        return response()->json(['message'=>"Profile Successfully Updated"]);
    }
}
    public function get_web_config()
    {
       $config=webconfig::first();
            return response()->json(['webconfig'=>$config]);

    }
}


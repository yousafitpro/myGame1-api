<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\appConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AppConfigController extends Controller
{
    public function add(Request $request)
    {
        $r=new appConfig();
        $r->app_name=$request->app_name;
        $r->app_version=$request->version;
        $r->app_id=$request->app_id;
        $r->app_link=$request->app_link;
        if($r->save())
        {
            Session::put('success-msg',"App Successfully Added");
        }

        return redirect(route('admin.app.getAll'));
    }
    public function getAll()
    {
        $list=appConfig::all();
        return view('admin.appConfig.appVersinManagement')->with(['list'=>$list]);
    }
    public function deleteOne($id)
    {
        $r=appConfig::find($id);
        if($r->delete())
        {
            Session::put('success-msg',"App Successfully Deleted");
        }
        return redirect(route('admin.app.getAll'));
    }

}

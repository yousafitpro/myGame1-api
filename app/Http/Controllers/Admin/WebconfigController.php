<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\webconfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class WebconfigController extends Controller
{
    public function getConfig()
    {
        if(webconfig::all()->count()==0)
        {
            $webConfig=new webconfig();
            $webConfig->save();
        }
        $webConfig=webconfig::first();
        return view('admin.webConfig.config')->with('config',$webConfig);
    }
    public function updateConfig(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company_name'=>'required',
            'company_short_name'=>'required',
            'company_email'=>'required',
            'company_phone'=>'required',
            'company_address'=>'required',
            'mylocale'=>'required',
            'front_navbar_color'=>'required',
            'front_navbar_position'=>'required',
            'backend_navbar_color'=>'required',
            'backend_navbar_position'=>'required',
        ]);

        if ($validator->fails())
        {
            return Redirect::route('admin.webConfig.getConfig')->withErrors($validator);
        }
        $webConfig=webconfig::first();
        $webConfig->company_name=$request->company_name;
        $webConfig->company_short_name=$request->company_short_name;
        $webConfig->company_email=$request->company_email;
        $webConfig->company_phone=$request->company_phone;
        $webConfig->company_address=$request->company_address;
        $webConfig->locale=$request->mylocale;
        $webConfig->front_navbar_color=$request->front_navbar_color;
        $webConfig->front_navbar_position=$request->front_navbar_position;
        $webConfig->backend_navbar_color=$request->backend_navbar_color;
        $webConfig->backend_navbar_position=$request->backend_navbar_position;
        if($webConfig->save())
        {
            if($request->hasFile('company_logo'))
            {
                $file = $request->file('company_logo');
                $extension = $file->getClientOriginalExtension();
                Storage::disk('public')->delete($webConfig->company_logo);
                $path = $request->file('company_logo')->storeAs('webimages',$webConfig->id.'.'.$extension);

                $webConfig->company_logo= $path;

                $webConfig->save();
            }
            Session::put('success-msg',"Web Configurations successfully Updated");
        }

        return Redirect::route('admin.webConfig.getConfig');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use function GuzzleHttp\Promise\all;

class roleController extends Controller
{
    public function addView()
    {
    return view('admin.role.add');
    }
  public function add(Request $request)
  {
      $validator = Validator::make($request->all(), [
          'name'=>'required|unique:roles',
      ]);

      if ($validator->fails())
      {
          return Redirect::route('admin.role.add')->withErrors($validator);
      }
      $role=new role();
      $role->name=$request->name;
      if($role->save())
      {
          Session::put('success-msg','Role Successfully Added');
      }
      return redirect(route('admin.role.add'));
  }
    public function getOne($id)
    {
         $role=role::find($id);

         return view('admin.role.update')->with('role',$role);
    }
    public function deleteOne($id)
    {
        $role=role::find($id);
        if($role->delete())
        {
            Session::put('success-msg',"Role Successfully Deleted");
        }
        return redirect(route('admin.role.getAll'));
    }
    public function update(Request $request,$id)
    {

        $role=role::find($id);
        $role->name=$request->name;
        if($role->save())
        {
            Session::put('success-msg',"Role Successfully Updated");
        }
        return redirect(route('admin.role.getAll'));
    }
    public function getAll()
    {
       $roles=role::where('user_id',Auth::user()->id)->with('user')->get();
       return view('admin.role.all')->with('roles',$roles);
    }
}

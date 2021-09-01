<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\paymentMethod;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PaymentMethodController extends Controller
{

        public function __construct()
    {
        $this->middleware('auth:web');
    }
    public function getAll()
    {
        $list=paymentMethod::all();
        return view('admin.paymentMethods.all')->with(['list'=>$list]);
    }
    public function add(Request $request)
    {
      $p=new paymentMethod();
      $p->title=$request->title;
        $p->private_key=$request->private_key;
        $p->public_key=$request->public_key;
        $p->api_key=$request->api_key;
        $p->status=$request->status;
        $p->account_holder_name=$request->account_holder_name;
        $p->account_user_name=$request->account_user_name;
        $p->account_mobile=$request->account_mobile;
        $p->account_id=$request->account_id;
if($p->save())
{
    Session::put('success-msg',"Payment Method Successfully Added");
}

        return redirect()->back();
    }
    public function update(Request $request,$id)
    {
        $p=paymentMethod::find($id);
        $p->title=$request->title;
        $p->private_key=$request->private_key;
        $p->public_key=$request->public_key;
        $p->api_key=$request->api_key;
        $p->status=$request->status;
        $p->account_holder_name=$request->account_holder_name;
        $p->account_user_name=$request->account_user_name;
        $p->account_mobile=$request->account_mobile;
        $p->account_id=$request->account_id;
        if($p->save())
        {
            Session::put('success-msg',"Payment Method Successfully Updated");
        }

        return redirect()->back();
    }
    public function active($id)
    {
        $p=paymentMethod::find($id);
        $p->status='1';
        if($p->save())
        {
            Session::put('success-msg',"Successfully Activated");
        }
        return redirect()->back();
    }
    public function unactive($id)
    {
        $p=paymentMethod::find($id);
        $p->status='0';
        if($p->save())
        {
            Session::put('success-msg',"Successfully Activated");
        }
        return redirect()->back();
    }
}

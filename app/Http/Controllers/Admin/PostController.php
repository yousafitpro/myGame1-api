<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function addView()
    {
        return view('admin.post.add');
    }
    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'=>'required',
            'contentdata'=>'required',
        ]);

        if ($validator->fails())
        {
            return Redirect::route('admin.post.add')->withErrors($validator);
        }
        $post=new post();
        $post->title=$request->title;
        $post->content=$request->contentdata;
        if($post->save())
        {
            Session::put('success-msg','Post Successfully Added');
        }
        return redirect(route('admin.post.add'));
    }
    public function getOne($id)
    {
        $post=post::find($id);

        return view('admin.post.update')->with('post',$post);
    }
    public function deleteOne($id)
    {
        $post=post::find($id);
        if($post->delete())
        {
            Session::put('success-msg',"Post Successfully Deleted");
        }
        return redirect(route('admin.post.getAll'));
    }
    public function update(Request $request,$id)
    {

        $post=post::find($id);
        $post->title=$request->title;
        $post->content=$request->contentdata;
        if($post->save())
        {
            Session::put('success-msg',"Post Successfully Updated");
        }
        return redirect(route('admin.post.getAll'));
    }
    public function getAll()
    {
        $posts=post::where('user_id',Auth::user()->id)->with('user')->get();
        return view('admin.post.all')->with('posts',$posts);
    }
}

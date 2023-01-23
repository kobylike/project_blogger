<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\registeredUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class commentController extends Controller
{
    //

    public function destroy(Post $post){

        $post->comments->delete();

    }

    public function show(Post $post){

        return view('pages.Blog.blog-single',compact('post'));
        }

    public function store(Request $request ){
        $request->validate([

            'comment_body'=> ['required', 'string'],
        ]);

        if(Session::has('loginID')){
            $post_id=$request->input('post_id');
            // $registered_user_id=registeredUser::get()->first()->id;
            $registeredUser=registeredUser::where('id','=',Session::get('loginID'))->first();
            $registered_user_id=$registeredUser->id;
            // $user_id=Auth::user()->id;

            $comment_body=$request->input('comment_body');
            $request =new Comment();
            $request->registered_user_id=$registered_user_id;
            $request->post_id= $post_id;
            $request->body=$comment_body;
            $request->save();
            if($request){
                return back()->with('success','Comment Posted Successfully');
            }

        else{

            return back()->with('failed','No such post found');
        }
   }
    else{

        return redirect('registered-user/login')->with('failed','Login first to comment');
    }

    }
}

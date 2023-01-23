<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\registeredUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BlogController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth')->except('index','show');
    }

    public function index(Request $request){

            if(Session::has('loginID')){

            $registeredUser=registeredUser::where('id','=',Session::get('loginID'))->first();
            
            if($registeredUser->status==0){
                Session::pull('loginID');
                abort(403);
            }
        }

        if($request->input('search')){
            $posts=Post::where('title','like','%' .$request->input('search'). '%')->

            orwhere('body','like','%' .$request->input('search'). '%')->latest()->paginate(5);
        }

        else if($request->category){
            $posts=Category::where('name',$request->category)->firstOrFail()->posts()->paginate(5)->withQueryString();

        }
        else{
            $posts=Post::latest()->paginate(5);
        }
        $registeredUser=registeredUser::all();
        $categories=Category::all();

        return view('pages.Blog.blog-index',compact('posts','categories','registeredUser'));
    }

    public function show(Post $post ){

        $category=$post->category;
        // $catnumber=Category::all();

        $relatedPosts=$category->posts()->where('id','!=',$post->id)->latest()->take(5)->get();

        return view('pages.Blog.blog-single', compact('post','relatedPosts'));
    }

    public function destroy(Post $post){

        if(auth()->user()->id==$post->user->id){


        $post->delete();
        }
        else{
            abort(403);
        }
        return back()->with('success','Deleted Successfully');
    }

    public function edit(Post $post){

        if(auth()->user()->id==$post->user->id){

        return view('pages.Blog.edit-blog',compact('post'));

        }
        else{
            abort(403);
        }

    }

    public function update(request $request){
        $request->validate([

            'title' => ['required', 'string'],
            'image' => 'required|image',
            'body' => ['required'],
        ]);

        $id=$request->input('id');
        $title=$request->input('title');
        $slug=Str::slug($title,'-');
        $image='storage/'. $request->file('image')->store('posts','public');
        $body=$request->input('body');

        $request=new Post();
        $request->title=$title;
        $request->slug=$slug;
        $request->image=$image;
        $request->body=$body;

        $query=Post::where('id','=',$id)->update([
            'title' =>$title,
            'slug' =>$slug,
            'image' =>$image,
            'body' =>$body,
        ]);

        if($query){
            return back()->with('success','Post Updated Successfully');

        }

    }

    public function create(){

        $categories=Category::all();


        return view('pages.Blog.create-blog', compact('categories'));
    }


    public function store(Request $request){


        $request->validate([

            'title' => ['required', 'string'],
            'image' => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
            'category_id' => 'required',
            'body' => ['required'],
        ]);


        $title=$request->input('title');
        if(Post::latest()->first() !== null){
            $postId=Post::latest()->first()->id + 1;
        }
        else{
            $postId=1;
        }

        $slug=Str::slug($title,'-').'-'.$postId;
        $image='storage/'. $request->file('image')->store('posts','public');
        $category_id=$request->input('category_id');
        $user_id=Auth::user()->id;
        $body=$request->input('body');

        $request =new Post();
        $request->title=$title;
        $request->slug=$slug;
        $request->image=$image;
        $request->category_id=$category_id;
        $request->user_id=$user_id;
        $request->body=$body;
        $request->save();

        if($request){

            return back()->with('success','Post added Successfully');
        }


    }
}

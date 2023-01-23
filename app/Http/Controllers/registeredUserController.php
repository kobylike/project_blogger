<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\registeredUser;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class registeredUserController extends Controller
{
    //

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }


    public function login(){

        return view('pages.registeredUsers.registeredUser-signin');
    }

    public function dashboard(){

        $registeredUser=registeredUser::where('id','=',Session::get('loginID'))->first();
        return view('pages.registeredUsers.registeredUser-dashboard',compact('registeredUser'));
    }

    public function logout(){

        if(Session::has('loginID')){

            Session::pull('loginID');
        }
        return view('pages.registeredUsers.registeredUser-signin');
    }

    // public function dashboard(){

    //     if(Session::has('loginID')){

    //         $registeredUser=registeredUser::where('id','=',Session::get('loginID'))->first();


    //         if($registeredUser->status==0){
    //             Session::pull('loginID');
    //             abort(403);

    //         }

    //     }

    //     return view('pages.Blog.blog-index',compact('registeredUser'));

    //     }



    public function signin(Request $request){

        $request->validate([
            'email'=>'required|email|string',
            'password' => 'required|min:8',

        ]);

        $query=registeredUser::where('email','=',$request->input('email'))->first();

        if($query){

            if(hash::check($request->input('password'),$query->password)){
                Session::put('loginID',$query->id);
                if($query->status==1){

                    // return redirect()->intended('registered-user/dashboard')->withSuccess('Welcome');
                    // return redirect()->intended('blog')->withSuccess('Welcome');
                    return redirect('/blog')->with('success','welcome');

                }
                else{
                    Session::invalidate();
                    Session::regenerateToken();
                    return back()->with('failed','Your account has been banned. Contact Administrator');
                }

            }
            else{

                return back()->with('failed','Password Error');
            }

        }
        else{
            return back()->with('failed','Email does not exist');
        }


    }
    public function register(){

        return view('pages.registeredUsers.registeredUser-signup');
    }


    public function store(Request $request){

        $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.registeredUser::class],
            'password' => 'min:8|required_with:password_confirm|same:password_confirm',
            'password_confirm' => 'min:8',
            'image'=>'required|image|mimes:png,jpeg',
        ]);


        $registeredUser=new registeredUser();
        $firstname=$request->input('firstname');
        $lastname=$request->input('lastname');
        $email=$request->input('email');
        $password=$request->input('password');
        $status=1;
        if($request->file('image')){

            $file=$request->file('image');
            $extention=$file->getClientOriginalExtension();
            $filename=time().'.'.$extention;
            $file->move('storage/registeredUserImages/', $filename);
            $registeredUser->image=$filename;
    }

    $registeredUser->firstname=$firstname;
    $registeredUser->lastname=$lastname;
    $registeredUser->email=$email;
    $registeredUser->password=bcrypt($password);
    $registeredUser->status=$status;
    $registeredUser->save();

    if($registeredUser){
        return back()->with('success','registration successful');
    }
}


    public function show(){


    }
}

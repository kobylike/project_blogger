<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Post;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index(){
        $posts=Post::latest()->take(3)->get();
        $employees=Employee::latest()->take(4)->get();
        return view('pages.index', compact('posts','employees'));
    }
}

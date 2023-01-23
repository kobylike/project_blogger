<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $categories=Category::all();

        return view('pages.Category.category-index',compact('categories'));
    }

    public function create(){

        return view('pages.Category.create-category');
    }

    public function store(Request $request){

        $request->validate([

            'name' => 'required | unique:categories',
        ]);

        $name=$request->input('name');
        $request=new Category();

        $request->name=$name;
        $request->save();

        if($request){
            return back()->with('success','Category Added Successfully ');
        }

    }

    public function edit(Category $category){

        return view('pages.Category.edit-category',compact('category'));

    }


    public function destroy(Category $category){

        $category->delete();

        return back()->with('success','Category deleted successfully');

    }

    public function update(request $request){

        $id=$request->input('id');
        $name=$request->input('name');
        $slug=Str::slug($name,'-');


        $request=new Category();
        $request->name=$name;
        $request->slug=$slug;

        $query=Category::where('id','=',$id)->update([
            'name' =>$name,

        ]);

        if($query){
            return back()->with('success','Category Updated Successfully');

        }



    }
}

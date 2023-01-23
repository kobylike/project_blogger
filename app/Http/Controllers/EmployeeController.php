<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    //



    public function index(){


        return view('pages.Employee.add-employee');
    }

    public function store(Request $request){

        $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|email|string|unique:employees',
            'password' => 'min:8|required_with:password_confirm|same:password_confirm',
            'password_confirm' => 'min:8',
            'phone'=>'required|numeric|min:11',
            'address'=>'required',
            'location'=>'required',
            'function'=>'required',
            'image'=>'required|image|mimes:png,jpeg',
        ]);


        // $image='storage.'.$request->file('image')->store('employeesImages', 'public');

        $employee=new Employee();
        $name=$request->input('name');
        $email=$request->input('email');
        $password=$request->input('password');
        $phone=$request->input('phone');
        $function=$request->input('function');
        $address=$request->input('address');
        $location=$request->input('location');
        $function=$request->input('function');
        $status=1;
        if($request->file('image')){

            $file=$request->file('image');
            $extention=$file->getClientOriginalExtension();
            $filename=time().'.'.$extention;
            $file->move('storage/employeesImages/', $filename);
            $employee->image=$filename;
        }

        $employee->name=$name;
        $employee->email=$email;
        $employee->password=$password;
        $employee->phone=$phone;
        $employee->function=$function;
        $employee->address=$address;
        $employee->location=$location;
        $employee->function=$function;

        $employee->status=$status;
        $employee->save();

        if($employee){
            return back()->with('success','registration successful');
        }
    }
}

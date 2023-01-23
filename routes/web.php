<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\commentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\registeredUserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//welcome route

Route::get('/',[WelcomeController::class,'index'])->name('/.index');


//blog

Route::get('blog/create',[BlogController::class,'create'])->name(('blog.create'))->middleware('auth');
Route::get('blog',[BlogController::class,'index'])->name('blog.index');
Route::get('blog/{post:slug}',[BlogController::class,'show'])->name(('blog.show'));
Route::post('blog/store',[BlogController::class,'store'])->name('blog.store');

Route::get('blog/delete/{post}',[BlogController::class,'destroy'])->name('blog.delete');
Route::get('blog/{post}/edit',[BlogController::class,'edit'])->name('blog.edit');
Route::post('blog/update',[BlogController::class,'update'])->name('blog.update');




//category

Route::get('category/create',[CategoryController::class,'create'])->name('category.create');

Route::get('category',[CategoryController::class,'index'])->name('category.index');
Route::post('category/store',[CategoryController::class,'store'])->name('category.store');
Route::get('category/delete/{category}',[CategoryController::class,'destroy'])->name('category.delete');
Route::get('category/{category}/edit',[CategoryController::class,'edit'])->name('category.edit');
Route::post('category',[CategoryController::class,'update'])->name('category.update');


//employee

Route::get('employee',[EmployeeController::class,'index'])->name('employee.index');
Route::post('employee/store',[EmployeeController::class,'store'])->name('employee.store');


//registedUser

Route::get('registered-user/register',[registeredUserController::class,'register'])->name('registeredUser.register');
Route::post('registered-user/store',[registeredUserController::class,'store'])->name('registeredUser.store');
Route::get('registered-user/login',[registeredUserController::class,'login'])->name('registeredUserlogin');
Route::post('registered-user/signin',[registeredUserController::class,'signin'])->name('registeredUser.signin');
Route::get('registered-user/dashboard',[registeredUserController::class,'dashboard'])->name('registeredUser.dashboard');
Route::get('registered-user/blog/show',[registeredUserController::class,'show'])->name('registeredUserblog.show');
Route::get('registered-user/blog/logout',[registeredUserController::class,'logout'])->name('registeredUserblog.logout');
// Route::get('blog/{post:slug}',[BlogController::class,'show'])->name(('blog.show'));

//comment
Route::get('comment/delete/{post}',[commentController::class,'destroy'])->name('comment.delete');
Route::post('comment/store',[commentController::class,'store'])->name('comment.store');

Route::get('comment/{post}',[commentController::class,'show'])->name('comment.show');





Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

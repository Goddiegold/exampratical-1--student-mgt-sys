<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get("/login", function(){
    if(session()->has('user-token')){
        return redirect("/dashboard");
    }else{
        return view("login");
}
})->name('login');

Route::get("/register",  function(){
    if(session()->has('user-token')){
        return redirect("/dashboard");
    }else{
        return view("register");
}
})->name('register');

Route::get("/dashboard",[StudentController::class, "getStudents"])->name('dashboard'); 

Route::post("/handle-login",[UserController::class, "handleLogin"]); //handles login request

Route::post("/handle-register",[UserController::class, "handleRegister"]); //handles register request


//return form to add student
Route::get('/add-student', function () {
    if(session()->has('user-token')){
        return view('add_student');
    }else{
        return redirect("/login")->with('message','Please Login First 😒!');
    }
});

Route::post('/handle-add-student',[StudentController::class,'handleAddStudent']); //handles add student request
Route::put('/handle-edit-student/{student}',[StudentController::class,'handleEditStudent']); //handles edit student request

Route::get('/delete-student/{student}',[StudentController::class,'handleDeleteStudent']);

Route::get('/edit-student/{student}',[StudentController::class, 'editStudent']);

Route::get('/view-student/{student}',[StudentController::class, 'viewStudent']);

Route::get('/logout',function(){
    if(session()->has('user-token')){
        session()->pull('user-token');
        return redirect("/login");
    }
})->name('logout');



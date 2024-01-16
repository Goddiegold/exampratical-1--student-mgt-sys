<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
        
        public function handleLogin(Request $request)  {
            $data = $request->validate([
                'email'=>'required|min:3|email',
                'password'=>'required|min:3|max:15',
            ]); 
    
            $user = DB::table('users')->where('email', $data['email'])->first();
            if ($user &&  Hash::check($data['password'], $user->password)) {
                $request->session()->put('user-token',$user);
                return redirect("/dashboard");
            } else {
                return response()->json(['message' => 'Invalid credentials'], 401);
            }
        }
    
        public function handleRegister(Request $request) {
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:3|max:15',
            ]);
           
            $hashedPassword = Hash::make($data['password']);
        
            // Insert a new record into the database
            $user = DB::table('users')->insert([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $hashedPassword,
            ]);
            return redirect("/login");
        }

       
}



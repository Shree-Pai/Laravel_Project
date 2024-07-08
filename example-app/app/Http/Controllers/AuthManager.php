<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthManager extends Controller
{
    function login(){
        if(Auth::check()){
            return redirect(route('home'));

        }
        return view('login');
    }

    function register(){
        if(Auth::check()){
            return redirect(route('home'));

        }
        return view('register');
    }
    function loginpost(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);

        $credentials=$request->only('email','password');
        if(Auth::attempt($credentials)){
                return redirect()->intended(Route('home'));
        }
        return redirect(route('login'))->with('error','Login details are not valid');
    }

    function registerpost(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required'
        ]);
        $data['name']=$request->name;
        $data['email']=$request->email;
        $data['password']=Hash::make( $request->password);
        $user=User::create($data);
        if(!$user){
            return redirect(route('register'))->with('error','Registration failed!! try again');
        }
        return redirect(route('login'))->with('success','Registration successful');

    }
    function logout(){
       Session::flush();
       Auth::logout();
       return redirect(route('login'));
    }
}

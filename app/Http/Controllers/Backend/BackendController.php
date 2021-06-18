<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BackendController extends Controller
{
    public function register(){
        return view('Backend.register');
    }


    public function login(){
        return view('Backend.login');
    }


    public function registersubmit(Request $request){

        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'password'=>'required|min:8',
            'passwordconfirmation' => 'required_with:password|same:password|min:8'
        ]);
        User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => bcrypt($request->passord)

        ]);
        return redirect()->route('login')->with('success','Created successfully');
    }


    public function loginsubmit(Request $request){
        $credentials = $request->only('email','password');
        if(Auth::attempt($credentials)){
            return redirect()->route('dashboard');
        }
        return redirect()->back()->with('error','Credential didnot match');
    }
}

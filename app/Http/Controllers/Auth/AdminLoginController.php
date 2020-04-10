<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Admin;
// use App\Admin;

class AdminLoginController extends Controller
{
    //
      //
      public function __construct(){
        $this->middleware('guest:admin')->except('logout');
    }
    public function showloginForm(){
        return view('auth.admin-login');
    }

    public function login(Request $request){
        //validate the form data
        $this->validate($request,[
            'email'=>'required|email',
            'password'=>'required|min:6'
        ]);
        //attempt to login
        if(Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password],$request->remember)){
            //if successsful , then redirect
            return redirect()->intended(route('admin.dashboard'));
        }
        return redirect()->back()->withinput($request->only('email','remember'));


    }
    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('/');
    }
}

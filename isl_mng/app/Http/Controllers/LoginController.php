<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    public function index(){
        return view('login');
    }

    public function checkLogin(Request $request){
        $check = $request -> only('email', 'password'); 
        if(Auth::attempt($check)){
            
       
            return redirect('schedules');

        }
        else{
            return redirect('/') ->withErrors('Please check email or password');;
        }
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect('login');
      }
    
    
}

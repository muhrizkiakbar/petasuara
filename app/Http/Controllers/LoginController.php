<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function getLogin(){

            return view('welcome');
    }

    public function  postLogin(Request $request){
        if (Auth::attempt([
            'username'=>$request->username,
            'password'=>$request->password
        ])){
          // dd(Auth::user()->role->namaRole="kadis");
          if (Auth::user()->role->namarole=="timses"){
            return redirect('/home');
          }
          elseif (Auth::user()->role->namarole=="timdes"){
            return redirect('/home');
          }
          elseif (Auth::user()->role->namarole=="caleg"){
            return redirect('/home');
          }
          elseif (Auth::user()->role->namarole=="superadmin"){
            return redirect('/home');
          }
        }else{
            return redirect()->back()->with('error', 'Login gagal !!');
        }
    }
}

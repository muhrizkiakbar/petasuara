<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
            return redirect('/home/timses');
          }
          elseif (Auth::user()->role->namarole=="caleg"){
            return redirect('/home');
          }
          elseif (Auth::user()->role->namarole=="superadmin"){
            return redirect('/home/admin');
          }
        }else{
            return redirect()->back()->with('error', 'Login gagal !!');
        }
    }
}

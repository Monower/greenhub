<?php

namespace App\Http\Controllers;

use App\Models\RepositoryName;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class UserLogin extends Controller
{
    public function login(Request $r){
        $validate=$r->validate([
            'email'=>'required|email',
            'password'=>'required|min:8'
        ]);

        if(Auth::attempt($validate)){
            $name=User::where('email',$r->email)->first();
            $r->session()->put('user',$name->user_name);

            return redirect(route('user.dashboard', ['id'=>$name->id]));
    }else{
        return redirect()->back()->withErrors(['msg'=>'email or password incorrect']);
    }

    }

    public function logout(){
        Auth::logout();

        return redirect(route('login'));
    }
}

<?php

namespace App\Http\Controllers;

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

/*             $name= DB::select('select user_name from users where email=?',[$r->email]);

            echo $name['user_name']; */

            $name=User::select('user_name')->where('email',$r->email)->first();

/*             echo $name->user_name; */

            $r->session()->put('user',$name->user_name);
            return redirect('profile');
    }else{
        return redirect()->back()->withErrors(['msg'=>'email or password incorrect']);
    }

    }

    public function logout(){
        Auth::logout();

        return redirect(route('login'));
    }
}

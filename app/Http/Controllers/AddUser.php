<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Auth;

class AddUser extends Controller
{
    public function add(Request $request){
        $validate=$request->validate([
            'user_name'=>'required|max:6',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:8|confirmed'
            
        ]);

            if($validate){
                User::create([
                    'user_name'=>$request->user_name,
                    'email'=>$request->email,
                    'password'=>Hash::make($request->password)
                ]);

                $request->session()->put('user',$request->user_name);


                return redirect('profile');
            }else{
                return redirect()->back()->withErrors($validate)->withInput($request->all());
            }
    }
}

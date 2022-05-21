<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AddUser extends Controller
{
    public function add(Request $r){
        $r->validate([
            'user_name'=>'required|max:6',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:8',
            'retype_password'=>'same:password'
        ]);

/*         if($errors->fails()){
            return redirect()->back()->withErrors($errors->errors);
        }else{ */
            $user=new User;

            $user->user_name=$r->user_name;
            $user->email=$r->email;
            $user->password=Hash::make($r->password);

            $user->save();

            $r->session()->put('user',$r->user_name);
            return redirect('profile');
/*         } */
    }
}

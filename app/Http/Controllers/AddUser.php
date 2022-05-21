<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AddUser extends Controller
{
    public function add(Request $r){
        $errors=$r->validate([
            'user_name'=>'required|max:6',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:8',
            'retype_password'=>'required|same:password|min:8'
        ]);

        if($errors->fails()){
            return redirect()->back()->withErrors($errors->errors);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\RepositoryName;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AddUser extends Controller
{
    public function add(Request $request){
/*         $validate=$request->validate([
            'user_name'=>'required|unique:users,user_name',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:8|confirmed'
            
        ]); */

        $validator = Validator::make($request->all(),[
            'user_name'=>'required|unique:users,user_name',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:8|confirmed'
        ]);


        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }else{
            User::create([
                'user_name'=>$request->user_name,
                'email'=>$request->email,
                'password'=>Hash::make($request->password)
            ]);

            $request->session()->put('user',$request->user_name);

            if(!Storage::disk('public')->exists('repositories/'.$request->email)){
                Storage::disk('public')->makeDirectory('repositories/'.$request->email);
            }

            $repository_name=RepositoryName::where('user_id', auth()->user()->id)->latest()->get();

            return view('pages.profile', ['repository_name'=>$repository_name]);
        }

/*             if($validate){
                User::create([
                    'user_name'=>$request->user_name,
                    'email'=>$request->email,
                    'password'=>Hash::make($request->password)
                ]);

                $request->session()->put('user',$request->user_name);


                return redirect(route('user-profile'));
            }else{
                return redirect()->back()->withErrors($validate)->withInput($request->all());
            } */
    }
}

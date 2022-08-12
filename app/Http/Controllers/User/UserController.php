<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\RepositoryName;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){
        $repository= RepositoryName::where('user_id', auth()->user()->id)->latest()->get();
        
        return view('pages.profile', ['repository'=>$repository]);
    }
    public function info_update(Request $request){

        $newFileName= auth()->user()->user_name.".".$request->user_image->extension();
        return $newFileName;
    }

    public function get_user_bookmarks(){
        return view('pages.bookmark');
    }

    public function get_user_message(){
        return view('pages.message');
    }

    public function get_notices(){
        return view('pages.notice');
    }

    public function search_user(Request $request){
        if($request->ajax()){


            $value =$request->search;

/*             $users = User::where(function($q) use($value){
                $q->orWhere('user_name', 'like', )
                    ->orWhere('email', 'like', "%{$value}%");
            })->get(); */

            $users = User::where('user_name', 'like', "%{$value}%")->get();
            if(isset($users)){
                return response()->json($users);
            }
            
        }
        
    }
}

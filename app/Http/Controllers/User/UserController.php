<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\RepositoryName;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){
        $repository_name= RepositoryName::where('user_id', auth()->user()->id)->latest()->get();
        
        return view('pages.profile', ['repository_name'=>$repository_name]);
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
}

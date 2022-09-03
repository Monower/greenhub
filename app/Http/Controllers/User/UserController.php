<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\RepositoryName;
use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index($id = null){
        if(isset($id)){
            $user = User::find($id);

            $repository= RepositoryName::where('user_id', $user->id)->latest()->get();
            return view('pages.profile', ['id'=>$user->id,'repository'=>$repository]);

        }
        $repository= RepositoryName::where('user_id', $id)->latest()->get();
        
        return view('pages.profile', ['repository'=>$repository]);
    }
    public function info_update(Request $request){
        if(!Storage::disk('public')->exists('image/profile')){
            Storage::disk('public')->makeDirectory('image/profile');
        }


        $user_info = UserInfo::where('user_id', auth()->user()->id)->first();
        if(isset($user_info)){
            if(Storage::disk('public')->exists('image/profile/'.$user_info->profile_picture_path)){
                Storage::delete('image/profile/'.$user_info->profile_picture_path);
                //unlink(storage_path())
            }
            if(isset($request->user_image)){
                $newFileName= auth()->user()->user_name.".".$request->user_image->extension();
                Storage::disk('public')->put('image/profile/'.$newFileName, file_get_contents($request->file('user_image')));
            }
            UserInfo::where('user_id', auth()->user()->id)->update([
                'about'=>$request->user_about,
                'address'=>$request->user_address,
                'profile_picture_path'=>isset($newFileName) ? $newFileName : null,
                'user_id'=>auth()->user()->id
            ]);
        }else{
            UserInfo::where('user_id', auth()->user()->id)->create([
                'about'=>$request->user_about,
                'address'=>$request->user_address,
                'profile_picture_path'=>isset($newFileName) ? $newFileName : null,
                'user_id'=>auth()->user()->id
            ]);
        }
        return back();

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

<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\RepositoryName;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Storage;

class RepositoryController extends Controller
{
    public function add_repository(Request $request){

        $validator = Validator::make($request->all(), [
            'name_of_the_repository'=>'required'
        ]);


        if($validator->fails()){
            return back()->withErrors($validator)->withInput($request->all());
        }

        $data = RepositoryName::where(['name'=>$request->name_of_the_repository, 'user_id'=>auth()->user()->id])->first();

        if(isset($data)){
            return back()->with(['message'=>'a repository with same name exists']);
        }
        
        if(!Storage::disk('public')->exists('repositories/'.auth()->user()->email)){
            Storage::disk('public')->makeDirectory('repositories/'.auth()->user()->email);

            Storage::disk('public')->makeDirectory('repositories/'.auth()->user()->email.'/'.$request->name_of_the_repository);

            RepositoryName::create([
                'name'=>$request->name_of_the_repository,
                'description'=>$request->description,
                'user_id'=>auth()->user()->id,
                'created_at'=>now()
            ]);
        }else{
            Storage::disk('public')->makeDirectory('repositories/'.auth()->user()->email.'/'.$request->name_of_the_repository);

            RepositoryName::create([
                'name'=>$request->name_of_the_repository,
                'description'=>$request->description,
                'user_id'=>auth()->user()->id,
                'created_at'=>now()
            ]);


            return redirect(route('user.show-repository',['name'=>$request->name_of_the_repository]));
        }
    }

    public function show_repository($name){

        $repository = RepositoryName::where(['name'=>$name, 'user_id'=>auth()->user()->id])->first();
        return view('pages.repository', ['repository'=>$repository]);
    }
}

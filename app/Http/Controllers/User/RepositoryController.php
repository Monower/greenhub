<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\RepositoryFile;
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

    public function add_file_to_repository(Request $request){

        $validator = Validator::make($request->all(),[
            'file'=>'required'
        ]);

        if ($validator->fails()){
            Toastr::warning('please select a file to upload');
            return back();
        }



        $repository_file_name = RepositoryFile::where(['name'=>$request->file('file')->getClientOriginalName(), 'repository_id'=>$request->repository_id])->first();

        if(isset($repository_file_name)){
            Toastr::warning('a file with the same name already exists in this repository');
            return back();
        }else{

            $repository = RepositoryName::find($request->repository_id);

            $file_name = $request->file('file')->getClientOriginalName();

            Storage::disk('public')->put('repositories/'.auth()->user()->email.'/'.$repository->name.'/'.$file_name, file_get_contents($request->file('file')));
        }
        return $request->file('file')->getClientOriginalName();
    }
}

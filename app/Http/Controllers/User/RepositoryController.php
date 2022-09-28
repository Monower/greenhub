<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\FileComment;
use App\Models\RepositoryFile;
use App\Models\RepositoryName;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\File;
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

            $repository = RepositoryName::create([
                'name'=>$request->name_of_the_repository,
                'description'=>$request->description,
                'user_id'=>auth()->user()->id,
                'created_at'=>now()
            ]);
        }else{
            Storage::disk('public')->makeDirectory('repositories/'.auth()->user()->email.'/'.$request->name_of_the_repository);

            $repository = RepositoryName::create([
                'name'=>$request->name_of_the_repository,
                'description'=>$request->description,
                'user_id'=>auth()->user()->id,
                'created_at'=>now()
            ]);


            return redirect(route('user.show-repository',['repository_id'=>$repository->id]));
        }
    }

    public function show_repository($repository_id, $user_id){

        $repository = RepositoryName::where(['id'=>$repository_id, 'user_id'=>$user_id])->first();
        $file_name = RepositoryFile::where('repository_id',$repository_id)->get();
        return view('pages.repository', ['repository'=>$repository, 'file_name'=>$file_name, 'user_id'=>$user_id]);
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

            RepositoryFile::create([
                'name'=>$file_name,
                'repository_id'=>$request->repository_id,
                'created_at'=>now()
            ]);

            Toastr::success('file uploaded successfully');
            return back();
        }
    }

    public function delete_repository(Request $request){

        if($request->repository_delete == 'yes'){
            $repository = RepositoryName::where(['id'=>$request->repository_id, 'user_id'=>auth()->user()->id])->first();
            $repository->delete();

            Toastr::success('Repository deleted successfully');
            return redirect(route('user.dashboard', ['id'=>auth()->user()->id]));
        }elseif($request->repository_delete == 'no'){
            return back();
        }
    }

    public function delete_file(Request $request){
        if($request->delete_file == 'yes'){
            $repository_file = RepositoryFile::where(['id'=>$request->file_id, 'repository_id'=>$request->repository_id])->first();
            $repository_file->delete();

            Toastr::success('File deleted successfully');
            return back();
        }elseif($request->delete_file == 'no'){
            return back();
        }
    }

    public function view_file($user_mail,$file_id){
        $file = RepositoryFile::with('repository_name')->find($file_id);
        //dd($file->repository_name->name);

/*         $contents = Storage::disk('public')->get('repositories/'.$user_mail.'/'.$file->repository_name->name.'/'.$file->name);
        foreach(array($contents) as $line){
            echo $line.'<br>';
        } */

/*         foreach(file(storage_path('repositories/'.$user_mail.'/'.$file->repository_name->name.'/'.$file->name)) as $line){
            echo $line;
        } */

        $handle  = fopen(storage_path('app/public/repositories/'.$user_mail.'/'.$file->repository_name->name.'/'.$file->name), 'r');

        if($handle){

/*             while(($line = fgets($handle)) != false){
                echo $line.'<br>';
            } */

            return view('pages.file', ['contents'=>$handle, 'file'=>$file]);
            //fclose($handle);
        }

/*         $directory = storage_path('app/public/repositories/'.$user_mail.'/'.$file->repository_name->name.'/'.$file->name);

        $files = File::get($directory);

        foreach ($files as $file) {
            $contents = $file->getContents();

            echo $contents;
        } */
    }

    public function add_comment(Request $request){

        FileComment::create([
            'file_id'=>$request->file_id,
            'user_id'=>$request->user_id,
            'comment'=>$request->comment,
            'created_at'=>now()
        ]);

        Toastr::success('Comment added successfully');
        return back();
    }
}

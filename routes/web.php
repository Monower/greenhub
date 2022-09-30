<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Middleware\Authenticate;
use App\Http\Controllers\AddUser;
use App\Http\Controllers\User\RepositoryController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\UserLogin;



Route::get('/', function () {
    return view('index');
})->name('login');

Route::get('signup', function () {
    return view('pages.signup');
})->name('user-signup');

Route::post('signup',[AddUser::class,'add']);


Route::post('login',[UserLogin::class,'login']);

Route::post('user-search', [UserController::class, 'search_user'])->name('search-user');

Route::name('user.')->prefix('user')->middleware('auth')->group(function(){
    Route::get('/dashboard/{id?}', [UserController::class,'index'])->name('dashboard');
    Route::post('info-update',[UserController::class,'info_update'])->name('info-update');
    Route::get('bookmarks',[UserController::class,'get_user_bookmarks'])->name('user_bookmarks');
    Route::get('message',[UserController::class,'get_user_message'])->name('get_user_message');
    Route::get('notice',[UserController::class,'get_notices'])->name('get_notices');
    Route::get('logout', [UserLogin::class,'logout'])->name('logout');
    Route::post('add-repository', [RepositoryController::class, 'add_repository'])->name('add-repository');
    Route::get('repository/{repository_id}/{user_id}', [RepositoryController::class, 'show_repository'])->name('show-repository');
    Route::post('add-file', [RepositoryController::class, 'add_file_to_repository'])->name('add-file');
    Route::post('delete-repository', [RepositoryController::class, 'delete_repository'])->name('delete-repository');
    Route::post('delete-file', [RepositoryController::class, 'delete_file'])->name('delete-file');
    Route::get('view-file/{user_mail}/{file_id}', [RepositoryController::class, 'view_file'])->name('view-file');
    Route::post('add-comment', [RepositoryController::class, 'add_comment'])->name('add-comment');
    Route::get('follow/{id}', [UserController::class, 'follow'])->name('follow');
    Route::get('unfollow/{id}', [UserController::class, 'unfollow'])->name('unfollow');
    Route::get('following', [UserController::class, 'following'])->name('following');
});

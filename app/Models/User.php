<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public $timestamps=false;

    protected $fillable=[
        'user_name',
        'email',
        'password'
    ];


    public function user_info(){
        return $this->hasOne(UserInfo::class);
    }

    public function repository(){
        return $this->hasMany(RepositoryName::class);
    }
}

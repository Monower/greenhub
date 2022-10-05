<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepositoryBookmark extends Model
{
    use HasFactory;

    protected $fillable=[
        'user_id', 'repository_id'
    ];

    public function repository(){
        return $this->belongsTo(RepositoryName::class, 'repository_id');
    }
}

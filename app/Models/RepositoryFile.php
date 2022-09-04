<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepositoryFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'repository_id',
    ];

    public function repository_name(){
        return $this->belongsTo(RepositoryName::class, 'repository_id ');
    }
}

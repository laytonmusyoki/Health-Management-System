<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Forgot extends Model
{
    protected $fillable =[
        'user_id','token','createdAt'
    ];
}

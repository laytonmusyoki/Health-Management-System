<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clinician extends Model
{
    protected $fillable = [
        'patient_id','signs','disease','medicine'
    ];
}

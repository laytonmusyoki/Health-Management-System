<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lab extends Model
{
    protected $fillable = [
        'patient_id','test','results'
    ];


    public function user(){
        return $this->belongsTo(registration::class,"patient_id");
    }
}

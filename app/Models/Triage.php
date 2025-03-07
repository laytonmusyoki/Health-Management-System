<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Triage extends Model
{
    protected $fillable =[
        "patient_id",
        "temperature",
        "pressure",
        "height",
        "weight",
    ];
}

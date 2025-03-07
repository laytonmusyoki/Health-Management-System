<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class registration extends Model
{
    protected $fillable = [
        'idNo','surName','firstName','secondName','gender','dateOfBirth','age','phoneNumber','nextOfKin','country','county','subCounty','location','occupation','maritalStatus','education','status'
    ];

    public function fullName(){
        return $this->firstName.' '.$this->secondName.' '.$this->surName;
    }
}

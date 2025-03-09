<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dispensation extends Model
{
    //
    protected $fillable = [
        'drug_id', 'patient_id', 'quantity_dispensed_mL', 'bottles_dispensed', 'dispensed_by'
    ];

    public function drug() {
        return $this->belongsTo(Drugs::class,'drug_id');
    }

    public function patient() {
        return $this->belongsTo(registration::class,'patient_id');
    }

    public function dispensedBy() {
        return $this->belongsTo(User::class, 'dispensed_by');
    }
}

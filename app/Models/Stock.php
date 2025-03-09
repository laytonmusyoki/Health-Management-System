<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = [
        'drug_id', 'batch_number', 'supplier', 'tablets_added', 'bottles_added', 'quantity_mL', 'expiry_date'
    ];

    public function drug() {
        return $this->belongsTo(Drugs::class,'drug_id');
    }
    
}

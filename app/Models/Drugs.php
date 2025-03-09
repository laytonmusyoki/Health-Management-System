<?php

namespace App\Models;

use App\Models\Dispensation;
use Illuminate\Database\Eloquent\Model;
use App\Models\Stock;

class Drugs extends Model
{
    protected $fillable = [
        'name', 'drug_type', 'unit_measurement', 
        'bottle_size_mL', 'bottles_in_stock', 'total_quantity_mL'
    ];

    public function stocks()
    {
        return $this->hasMany(Stock::class, 'drug_id');
    }
    public function latestStock()
    {
        return $this->hasOne(Stock::class,'drug_id')->latest();
    }


    public function dispensations() {
        return $this->hasMany(Dispensation::class);
    }
}

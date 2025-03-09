<?php

namespace Database\Seeders;

use App\Models\Drugs;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DrugsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $drugs = [
            [
                'name' => 'Paracetamol',
                'drug_type' => 'tablet',
                'unit_measurement' => 'tablets',
                'bottle_size_mL' => null,
                'bottles_in_stock' => 0,
                'total_quantity_mL' => 0,
            ],
            [
                'name' => 'Ibuprofen',
                'drug_type' => 'tablet',
                'unit_measurement' => 'tablets',
                'bottle_size_mL' => null,
                'bottles_in_stock' => 0,
                'total_quantity_mL' => 0,
            ],
            [
                'name' => 'Amoxicillin',
                'drug_type' => 'tablet',
                'unit_measurement' => 'tablets',
                'bottle_size_mL' => null,
                'bottles_in_stock' => 0,
                'total_quantity_mL' => 0,
            ],

            // Liquid Drugs
            [
                'name' => 'Cough Syrup',
                'drug_type' => 'liquid',
                'unit_measurement' => 'mL',
                'bottle_size_mL' => 100,
                'bottles_in_stock' => 50,
                'total_quantity_mL' => 50 * 100, 
            ],
            [
                'name' => 'Vitamin Syrup',
                'drug_type' => 'liquid',
                'unit_measurement' => 'mL',
                'bottle_size_mL' => 150,
                'bottles_in_stock' => 30,
                'total_quantity_mL' => 30 * 150,
            ],
            [
                'name' => 'Antibiotic Suspension',
                'drug_type' => 'liquid',
                'unit_measurement' => 'mL',
                'bottle_size_mL' => 200,
                'bottles_in_stock' => 20,
                'total_quantity_mL' => 20 * 200,
            ],
        ];

        foreach ($drugs as $drug) {
            Drugs::create($drug);
        }
    
    }
}

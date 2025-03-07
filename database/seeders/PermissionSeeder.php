<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $modules=[
            'Registration',
            'Triage',
            'Clinician',
            'Drug Prescription',
            'Lab',
            'Billing',
            'HIV Testing',
            'Ward',
            'Procedure Room',
            'Patient Tracking'
        ];
        foreach($modules as $module){
            $permissionExists=Permission::where('name',$module)->first();
            if(!$permissionExists){
                Permission::create(['name'=>$module]);
            }
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\County;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = file_get_contents(base_path('public/units/counties.json'));
        $names = json_decode($json,true);

        foreach($names as $key => $counties){
            foreach($counties as $county){
                $datas = County::where('name',$county['name'])->first();
                if($datas){
                    continue;
                }
                else{
                    $newCounties = new County();
                    $newCounties->name = $county['name'];
                    $newCounties->code = $county['code'];
                    $newCounties->save();
                }
            }
        }
    }
}

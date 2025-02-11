<?php

namespace Database\Seeders;

use App\Models\SubCounty;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubCountiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = file_get_contents(base_path('public/units/subCounty.json'));

        $names = json_decode($json,true);
        foreach($names as $key=>$subCounties){
            foreach($subCounties as $subCounty){
                $code = SubCounty::where('countyId',$subCounty['code'])->first();
                    if($code){
                        continue;
                    }
                    else{
                        foreach($subCounty['sub_counties'] as $datas){
                            $record = SubCounty::where('name',$datas)->first();
                            $newData = new SubCounty();
                            $newData->countyId = $subCounty['code'];
                            if($record){
                                continue;
                            }
                            else{
                                $newData->name = $datas;
                                $newData->save();
                            }
                            
                        }
                    }
                }
            }
        }

}

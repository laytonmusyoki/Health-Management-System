<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class StaffController extends Controller
{
    public $all_modules;
    //
    public function index(){
        $json = file_get_contents(base_path('/public/units/modules.json'));
        $json = json_decode($json, true);
        if (isset($json['modules'])) {
            $modules = $json['modules']; 
        } else {
            $modules = []; 
        }
    return view('staff.index', compact('modules'));      
    }
}

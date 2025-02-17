<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class StaffController extends Controller
{
    public $all_modules;
    //
    public function index(){
        $userPermissions = auth()->user()->getAllPermissions()->pluck('name');
        $modulesData = json_decode(file_get_contents(base_path('/public/units/modules.json')), true);
        $modules = $modulesData['modules'];

        // here we are filtering modules based on user permissions
        $filteredModules = array_filter($modules, function($module) use($userPermissions) {
            return isset($module['permission']) && $userPermissions->contains($module['permission']);
        });

        return view('staff.index', compact('filteredModules'));
    }
}

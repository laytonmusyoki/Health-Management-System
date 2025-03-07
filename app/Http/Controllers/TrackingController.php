<?php

namespace App\Http\Controllers;

use App\Models\registration;
use App\Models\Tracking;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $userPermissions = auth()->user()->getAllPermissions()->pluck('name');
        $modulesData = json_decode(file_get_contents(base_path('/public/units/modules.json')), true);
        $modules = $modulesData['modules'];
    
        // Filter modules based on user permissions
        $filteredModules = array_filter($modules, function ($module) use ($userPermissions) {
            return isset($module['permission']) && $userPermissions->contains($module['permission']);
        });
    
        // Fetch patient counts for the last 7 days
        $week_labels = [];
        $week_data = [];
    
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i)->toDateString();
            $week_labels[] = Carbon::today()->subDays($i)->format('D'); // Example: Mon, Tue, Wed
            $week_data[] = registration::whereDate('updated_at', $date)->count();
        }
        $todays_patients = registration::whereDate('updated_at', Carbon::today())->count();
        $total_visits=registration::all()->count();
        return view('staff.tracking.index', compact('filteredModules', 'week_labels', 'week_data', 'todays_patients','total_visits'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($queue)
    {
        $patients = registration::where('status', $queue)->get();
        return view('staff.tracking.show', compact('patients'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tracking $tracking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tracking $tracking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tracking $tracking)
    {
        //
    }
}

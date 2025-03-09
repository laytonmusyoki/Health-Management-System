<?php

namespace App\Http\Controllers;

use App\Models\Drugs;
use App\Models\Dispensation;
use App\Models\registration;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Http\Request;

class PharmacyController extends Controller
{
    public function index()
    {
        $drugs = Drugs::with('stocks')->get();
        $patients = registration::all();
        $labPatient=registration::where('status','PharmacyQueue')->get();
        return view('staff.pharmacy.index', compact('drugs', 'patients','labPatient'));
    }

    public function store(Request $request)
{
    // Validate the incoming request
    $request->validate([
        'drug_id' => 'required|exists:drugs,id',
        'patient_id' => 'required|exists:registrations,id',
        'quantity_dispensed_mL' => 'nullable|integer|min:1',
        'bottles_dispensed' => 'nullable|integer|min:1',
    ]);

    $drug = Drugs::findOrFail($request->drug_id);
    $stock = $drug->stocks()->first(); 

    if ($drug->drug_type == 'tablet') {
        $requestedQuantity = $request->quantity_dispensed_mL;
        if ($requestedQuantity > $stock->tablets_added) {
            return back()->with('error', 'Not enough tablets in stock.');
        }

        $stock->tablets_added -= $requestedQuantity;
        $stock->save();
        
        Dispensation::create([
            'drug_id' => $request->drug_id,
            'patient_id' => $request->patient_id,
            'quantity_dispensed_mL' => $requestedQuantity,
            'dispensed_by' => auth()->id(),
        ]);
    }
    elseif ($drug->drug_type == 'bottle') {
        $requestedBottles = $request->bottles_dispensed;
        if ($requestedBottles > $stock->bottles_added) {
            return back()->with('error', 'Not enough bottles in stock.');
        }

        $stock->bottles_added -= $requestedBottles;
        $stock->save();
        
        Dispensation::create([
            'drug_id' => $request->drug_id,
            'patient_id' => $request->patient_id,
            'bottles_dispensed' => $requestedBottles,
            'dispensed_by' => auth()->id(),
        ]);
    }
    else {
        $requestedQuantity = $request->quantity_dispensed_mL;
        if ($requestedQuantity > $stock->quantity_mL) {
            return back()->with('error', 'Not enough liquid in stock.');
        }

        $stock->quantity_mL -= $requestedQuantity;
        $stock->save();
        
        Dispensation::create([
            'drug_id' => $request->drug_id,
            'patient_id' => $request->patient_id,
            'quantity_dispensed_mL' => $requestedQuantity,
            'dispensed_by' => auth()->id(),
        ]);
    }

    return back()->with('success', 'Drug dispensed successfully!');
}



}

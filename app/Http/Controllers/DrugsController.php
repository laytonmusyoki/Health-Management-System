<?php

namespace App\Http\Controllers;

use App\Models\Drugs;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DrugsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $restocks = Stock::with('drug')->get(); 
        $drugs = Drugs::with('stocks')->get();
        return view("staff.drugs.index", compact('restocks', 'drugs'));
    }

    /**
     * Restock a drug.
     */
    public function restock(Request $request)
{
    // Validate the incoming request data
    $validator = Validator::make($request->all(), [
        'drug_id' => 'required|exists:drugs,id',
        'batch_number' => 'required',
        'supplier' => 'required',
        'bottles_added' => 'nullable|numeric|min:0',
        'quantity_mL' => 'nullable|numeric|min:0',
        'tablets_added' => 'nullable|numeric|min:0',
        'expiry_date' => 'required|date|after:today',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $drug = Drugs::findOrFail($request->drug_id);

    $isTablet = strtolower($drug->drug_type) === 'tablet';
    
    $stock = Stock::where('drug_id', $drug->id)
                  ->first();

    if ($isTablet) {
        if ($request->tablets_added < 0) {
            return redirect()->back()->withErrors(['tablets_added' => 'Tablets added cannot be negative.'])->withInput();
        }

        if ($stock) {
            $stock->tablets_added += $request->tablets_added ?? 0;
            $stock->batch_number = $request->batch_number;
            $stock->supplier = $request->supplier;
            $stock->save();
        } else {
            Stock::create([
                'drug_id' => $drug->id,
                'batch_number' => $request->batch_number,
                'supplier' => $request->supplier,
                'tablets_added' => $request->tablets_added ?? 0,
                'expiry_date' => $request->expiry_date,
            ]);
        }

        $drug->update([
            'tablets_in_stock' => $drug->tablets_in_stock + ($request->tablets_added ?? 0),
        ]);
    } else {
        $bottlesInMl = ($request->bottles_added ?? 0) * 1000;

        if ($request->bottles_added < 0 || $request->quantity_mL < 0) {
            return redirect()->back()->withErrors(['bottles_added' => 'Bottles and quantity cannot be negative.'])->withInput();
        }

        if ($stock) {
            $stock->bottles_added += $request->bottles_added ?? 0;
            $stock->quantity_mL += $request->quantity_mL ?? 0;
            $stock->batch_number = $request->batch_number;
            $stock->supplier = $request->supplier;

            $stock->save();
        } else {
            Stock::create([
                'drug_id' => $drug->id,
                'batch_number' => $request->batch_number,
                'supplier' => $request->supplier,
                'bottles_added' => $request->bottles_added ?? 0,
                'quantity_mL' => $request->quantity_mL ?? 0,
                'expiry_date' => $request->expiry_date,
            ]);
        }

        $drug->update([
            'bottles_in_stock' => $drug->bottles_in_stock + ($request->bottles_added ?? 0),
            'total_quantity_mL' => $drug->total_quantity_mL + ($bottlesInMl) + ($request->quantity_mL ?? 0),
        ]);
    }

    return redirect()->route('drugs.index')->with('success', 'Drug restocked successfully!');
}



    /**
     * Display drug stock levels.
     */
    public function stockLevels()
    {
        $drugs = Drugs::select('id', 'name', 'bottles_in_stock', 'total_quantity_mL')->get();
        return view('staff.drugs.stock_levels', compact('drugs'));
    }

    /**
     * Track expiration dates.
     */
    

public function viewStock($id)
{
    $drug = Drugs::findOrFail($id);
    return view('staff.drugs.viewStock', compact('drug'));
}

public function trackExpiry($id)
{
    $drug = Drugs::with('stocks')->findOrFail($id);
    return view('staff.drugs.trackExpiry', compact('drug'));
}


}

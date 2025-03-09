@extends('staff.app')
@section('title', 'Users')
@section('content')
<style>
    textarea{
        width: 100%;
        height: 50px;
    }
</style>

<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">{{$patients->fullName()}}</div>
</div>
<!--end breadcrumb-->

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-title" style="background:rgb(106, 106, 244); padding: 10px; color: white; font-weight: bold; ">
                Pharmarcy Data
            </div>
            <div class="card-body">
                <p style="font-size: 20px;">Signs&Symptoms: <span style="font-size: 15px;">{{ $patient->signs }}</span></p>
                <p style="font-size: 20px;">Disease: <span style="font-size: 15px;">{{ $patient->disease }}</span></p>
                <p style="font-size: 20px;">Medicine: <span style="font-size: 15px;">{{ $patient->medicine }}</span></p>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-title" style="background:rgb(39, 35, 35); padding: 10px; color: white; font-weight: bold; ">
                Medicine dispensing
            </div>
            <div class="card-body">
                <form action="{{ route('pharmacy.store') }}" method="POST">
                    @csrf

                    <!-- Drug Selection -->
                    <div class="mb-3">
                        <label for="drug_id" class="form-label">Select Drug</label>
                        <select name="drug_id" id="drug_id" class="form-control" required>
                            <option value="">-- Choose Drug --</option>
                            @foreach($drugs as $drug)
                                @php
                                    $totalQuantityML = $drug->stocks->sum('quantity_mL');
                                    $totalBottles = $drug->stocks->sum('bottles_added');
                                    $totalTablets = $drug->stocks->sum('tablets_added');
                                @endphp
                                <option value="{{ $drug->id }}"
                                    data-type="{{ $drug->drug_type }}"
                                    data-stock="{{ $totalQuantityML }}"
                                    data-bottles="{{ $totalBottles }}"
                                    data-tablets="{{ $totalTablets }}">
                                    {{ $drug->name }} ({{ ucfirst($drug->drug_type) }})
                                </option>
                            @endforeach

                        </select>
                        @error('drug_id') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <!-- Patient Selection -->
                    <div class="mb-3">
                        <label for="patient_id" class="form-label">Select Patient</label>
                        <input type="text" id="patient_id" class="form-control" readonly value="{{$patients->fullName()}}">
                        <input type="text" name="patient_id" value="{{$patients->id}}" hidden>

                        @error('patient_id') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <!-- Quantity for Tablets/Liquids -->
                    <div class="mb-3" id="quantity_section" style="display: none;">
                        <label for="quantity_dispensed_mL" class="form-label">Quantity (mL/Tablets)</label>
                        <input type="number" name="quantity_dispensed_mL" id="quantity_dispensed_mL" class="form-control" min="0">
                        <small class="text-muted">Available: <span id="stock_amount">0</span></small>
                        @error('quantity_dispensed_mL') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <!-- Bottles for Bottle Drugs -->
                    <div class="mb-3" id="bottle_section" style="display: none;">
                        <label for="bottles_dispensed" class="form-label">Number of Bottles</label>
                        <input type="number" name="bottles_dispensed" id="bottles_dispensed" class="form-control" min="0">
                        <small class="text-muted">Available: <span id="bottle_stock">0</span></small>
                        @error('bottles_dispensed') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Dispense</button>
                </form>
            </div>
        </div>
    </div>
</div>


<x-sweet-alert/>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const drugSelect = document.getElementById("drug_id");
        const quantitySection = document.getElementById("quantity_section");
        const bottleSection = document.getElementById("bottle_section");
        const stockAmount = document.getElementById("stock_amount");
        const bottleStock = document.getElementById("bottle_stock");

        drugSelect.addEventListener("change", function() {
            let selectedOption = drugSelect.options[drugSelect.selectedIndex];
            let drugType = selectedOption.getAttribute("data-type");
            let availableStock = selectedOption.getAttribute("data-stock") || 0;
            let availableBottles = selectedOption.getAttribute("data-bottles") || 0;
            let availableTablets = selectedOption.getAttribute("data-tablets") || 0;

            if (drugType === "bottle") {
                quantitySection.style.display = "none";
                bottleSection.style.display = "block";
                bottleStock.textContent = availableBottles;
            } else {
                quantitySection.style.display = "block";
                bottleSection.style.display = "none";
                stockAmount.textContent = drugType === "tablet" ? availableTablets : availableStock;
            }
        });
    });

    </script>

@endsection

@extends('staff.app')

@section('content')
<div class="container">
    <h2>Dispense Drug</h2>

    <div class="card">
        <div class="card-body">
            <table class="table table-hover table-striped" id="example4">
                <thead>
                    <th>IdNo</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Phone number</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach ($labPatient as $data )
                    <tr>
                        <td>{{ $data->idNo }}</td>
                        <td><a href="{{route('lab.show',$data->id)}}">{{ $data->fullName() }}</a></td>
                        <td>{{ $data->age }}</td>
                        <td>{{ $data->phoneNumber }}</td>
                        <td>
                           <a href="{{route('lab.show',$data->id)}}" class="btn btn-success">Test</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
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
            <select name="patient_id" id="patient_id" class="form-control" required>
                <option value="">-- Choose Patient --</option>
                @foreach($patients as $patient)
                    <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                @endforeach
            </select>
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

@extends('staff.app')
@section('title', 'Drugs')


@section('content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Drugs</div>
</div>


<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h5 class="mb-0">Drug Inventory</h5>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#restockModal">Restock Drugs</button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped" id="example4">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Stock (Bottles/Tablets)</th>
                        <th>Total Quantity (mL/Tablets)</th>
                        <th>Batch Number</th>
                        {{-- <th>Supplier</th> --}}
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($drugs as $drug)
                        <tr>
                            <td>{{ $drug->name }}</td>
                            <td>{{ ucfirst($drug->drug_type) }}</td>
                            <td>
                                @if(strtolower($drug->drug_type) === 'tablet')
                                    {{ $drug->stocks->sum('tablets_added') ?: 0 }} Tablets
                                @else
                                    {{ $drug->stocks->sum('bottles_added') ?: 0 }} Bottles
                                @endif
                            </td>
                            <td>
                                @if(strtolower($drug->drug_type) === 'tablet')
                                    {{ $drug->stocks->sum('tablets_added') ?: 0 }} Tablets
                                @else
                                    {{ $drug->stocks->sum('quantity_mL') ?: 0 }} mL
                                @endif
                            </td>
                            <td>{{ $drug->stocks->last()->batch_number ?? '-' }}</td>
                            {{-- <td>{{ $drug->stocks->last()->supplier ?? '-' }}</td> --}}
                            <td>
                                <a href="{{ route('drugs.viewStock', $drug->id) }}" class="btn btn-info btn-sm">View Stock</a>
                                <a href="{{ route('drugs.trackExpiry', $drug->id) }}" class="btn btn-warning btn-sm">Track Expiry</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Restock Drugs Modal -->
<div class="modal fade" id="restockModal" tabindex="-1" aria-labelledby="restockModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="restockModalLabel">Restock Drugs</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('drugs.restock') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="drug_id" class="form-label">Select Drug</label>
                        <select class="form-control" name="drug_id" id="drug_id" required>
                            <option value="">-- Select Drug --</option>
                            @foreach($drugs as $drug)
                                <option value="{{ $drug->id }}" data-type="{{ strtolower($drug->drug_type) }}">{{ $drug->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="batch_number" class="form-label">Batch Number</label>
                        <input type="text" class="form-control" name="batch_number" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="supplier" class="form-label">Supplier</label>
                        <input type="text" class="form-control" name="supplier" required>
                    </div>

                    <div id="liquid-fields" class="d-none">
                        <div class="mb-3">
                            <label for="bottles_added" class="form-label">Bottles Added</label>
                            <input type="number" class="form-control" name="bottles_added" min="0" value="0" id="bottles_added">
                        </div>
                        <div class="mb-3">
                            <label for="quantity_mL" class="form-label">Total Quantity (mL)</label>
                            <input type="number" class="form-control" name="quantity_mL" min="0" value="0" readonly id="quantity_mL">
                        </div>
                    </div>

                    <div id="tablet-fields" class="d-none">
                        <div class="mb-3">
                            <label for="tablets_added" class="form-label">Tablets Added</label>
                            <input type="number" class="form-control" name="tablets_added" min="0" value="0">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="expiry_date" class="form-label">Expiry Date</label>
                        <input type="date" class="form-control" name="expiry_date" required>
                    </div>

                    <button type="submit" class="btn btn-success">Restock Drug</button>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- Restock History -->
<div class="card mt-4">
    <div class="card-header">
        <h5 class="mb-0">Restock History</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Drug Name</th>
                        <th>Type</th>
                        <th>Batch Number</th>
                        <th>Supplier</th>
                        <th>Bottles Added</th>
                        <th>Quantity (mL)</th>
                        <th>Tablets Added</th>
                        <th>Expiry Date</th>
                        <th>Restocked At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($restocks as $restock)
                    <tr>
                        <td>{{ $restock->drug->name }}</td>
                        <td>{{ ucfirst($restock->drug->drug_type) }}</td>
                        <td>{{ $restock->batch_number }}</td>
                        <td>{{ $restock->supplier }}</td>
                        <td>{{ $restock->bottles_added ?: '-' }}</td>
                        <td>{{ $restock->quantity_mL ? $restock->quantity_mL . ' mL' : '-' }}</td>
                        <td>{{ $restock->tablets_added ?: '-' }}</td>
                        <td>{{ \Carbon\Carbon::parse($restock->expiry_date)->format('d M, Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($restock->created_at)->diffForHumans() }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const drugSelect = document.getElementById("drug_id");
        const liquidFields = document.getElementById("liquid-fields");
        const tabletFields = document.getElementById("tablet-fields");

        drugSelect.addEventListener("change", function() {
            const drugType = drugSelect.options[drugSelect.selectedIndex].getAttribute("data-type");

            if (drugType === "tablet") {
                tabletFields.classList.remove("d-none");
                liquidFields.classList.add("d-none");
            } else {
                liquidFields.classList.remove("d-none");
                tabletFields.classList.add("d-none");
            }
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const drugSelect = document.getElementById("drug_id");
        const liquidFields = document.getElementById("liquid-fields");
        const tabletFields = document.getElementById("tablet-fields");
        const bottlesInput = document.getElementById("bottles_added");
        const quantityMlInput = document.getElementById("quantity_mL");

        drugSelect.addEventListener("change", function() {
            const drugType = drugSelect.options[drugSelect.selectedIndex].getAttribute("data-type");

            if (drugType === "tablet") {
                tabletFields.classList.remove("d-none");
                liquidFields.classList.add("d-none");
            } else {
                liquidFields.classList.remove("d-none");
                tabletFields.classList.add("d-none");
            }
        });

        // When bottles are added, calculate mL (1 bottle = 1000 mL)
        bottlesInput.addEventListener("input", function() {
            const bottlesAdded = parseFloat(bottlesInput.value) || 0;
            const calculatedMl = bottlesAdded * 1000; // 1 bottle = 1000 mL
            quantityMlInput.value = calculatedMl;
        });
    });
</script>

@endsection

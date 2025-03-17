@extends('staff.app')
@section('title', 'Users')
@section('content')

<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Triage</div>
</div>
Queued Patients
<!--end breadcrumb-->

<div class="product-count d-flex align-items-center gap-3 gap-lg-4 mb-4 fw-medium flex-wrap font-text1">
    <a href="javascript:;"><span class="me-1">All</span><span class="text-secondary">
       ( {{ $triage->count() }} ) 
    </span></a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped" id="example4">
                <thead>
                    <th>IdNo</th>
                    <th>Name</th>
                    <th>Age</th> 
                    <th>Phone number</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach ($triage as $data )
                    <tr>   
                        <td>{{ $data->idNo }}</td>
                        <td>{{ $data->fullName() }}</td>
                        <td>{{ $data->age }}</td>
                        <td>{{ $data->phoneNumber }}</td>
                        <td>
                            <button class="btn btn-success triage-btn" 
                                data-id="{{ $data->id }}" 
                                data-name="{{ $data->fullName() }}" 
                                data-age="{{ $data->age }}" 
                                data-phone="{{ $data->phoneNumber }}"
                                data-bs-toggle="modal" 
                                data-bs-target="#triageModal">
                                Triage
                            </button>
                        </td>
                    </tr>                    
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="triageModal" tabindex="-1" aria-labelledby="triageModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="triageModalLabel">Triage Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('triage.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="patient_id" id="patient_id">
                    
                    <div class="mb-3">
                        <label for="temperature" class="form-label">Temperature (°C)</label>
                        <input type="number" step="0.1" class="form-control" name="temperature" placeholder="Enter temperature" required>
                    </div>
                    <div class="mb-3">
                      <label for="temperature" class="form-label">Blood Pressure (mmHg)</label>
                      <input type="number" step="0.1" class="form-control" name="pressure" placeholder="Enter Blood preasure" required>
                  </div>

                    <div class="mb-3">
                        <label for="height" class="form-label">Height (cm)</label>
                        <input type="number" class="form-control" name="height" placeholder="Enter height" required>
                    </div>

                    <div class="mb-3">
                        <label for="weight" class="form-label">Weight (kg)</label>
                        <input type="number" class="form-control" name="weight" placeholder="Enter weight" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".triage-btn").forEach(button => {
        button.addEventListener("click", function() {
            let patientId = this.getAttribute("data-id");
            document.getElementById("patient_id").value = patientId;
        });
    });
});
</script>

@endsection

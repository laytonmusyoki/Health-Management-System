@extends('staff.app')
@section('title', 'Users')
@section('content')

<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Clinician</div>
</div>
<!--end breadcrumb-->
Queued Patients
<!--end breadcrumb-->

<div class="product-count d-flex align-items-center gap-3 gap-lg-4 mb-4 fw-medium flex-wrap font-text1">
    <a href="javascript:;"><span class="me-1">All</span><span class="text-secondary">
        ({{ $appointments->count() }})
    </span></a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-hover table-striped" id="example4">
            <thead>
                <th>Patient Name</th>
                <th>Email</th>
                <th>Phone number</th>
                <th>Date</th>
                <th>Time</th>
                <th>Status</th>
                <th>Action</th>
            </thead>
            <tbody>
                @foreach ($appointments as $data )
                <tr>
                    <td>{{ $data->patientName }}</td>
                    <td>{{ $data->email }}</td>
                    <td>{{ $data->phone }}</td>
                    <td>{{ $data->date }}</td>
                    <td>{{ $data->time }}</td>
                    <td>
                        @if( $data->status == "Pending")
                        <p class="badge bg-warning">Pending</p>
                        @elseif($data->status == "Approved")
                        <p class="badge bg-success">Approved</p>
                        @else
                        <p class="badge bg-danger">Cancelled</p>
                        @endif
                    </td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-filter dropdown-toggle dropdown-toggle-nocaret"
                                    type="button" data-bs-toggle="dropdown">
                                <i class="bi bi-three-dots"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item show" href="{{route('clinician.appointments.show',$data->id)}}"><i class="bi bi-pencil-square me-2"></i>Show</a></li>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection

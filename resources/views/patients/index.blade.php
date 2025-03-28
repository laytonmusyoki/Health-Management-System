@extends('patients.app')

@section('title','Dashboard')

@section('content')

<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">

    Dashboard

    </div>

</div>

{{-- my appointments --}}
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
            <a href="{{route('appointments')}}" class="btn btn-primary" style="float: right; margin: 10px;;">Make Appointment</a>

                <h5 class="card-title">My Appointments</h5>
                <table class="table" id="example2">
                    <thead>
                        <tr>
                            <th>Doctor</th>
                            <th>patientName</th>
                            <th>Phone</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($appointments as $appointment)
                        <tr>
                            <td>{{ $appointment->doctor->name }}</td>
                            <td>{{ $appointment->patientName }}</td>
                            <td>{{ $appointment->phone }}</td>
                            <td>{{ $appointment->date }}</td>
                            <td>{{ $appointment->time }}</td>
                            <td>
                                @if ($appointment->status == 'Pending')
                                    <span class="badge bg-warning text-dark">{{ $appointment->status }}</span>
                                @elseif ($appointment->status == 'Approved')
                                    <span class="badge bg-success">{{ $appointment->status }}</span>
                                @else
                                    <span class="badge bg-danger">{{ $appointment->status }}</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



@endsection

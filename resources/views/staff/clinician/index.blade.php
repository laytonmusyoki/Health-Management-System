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
       ( {{ $patients->count() }} )
    </span></a>
</div>

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
                @foreach ($patients as $data )
                <tr>
                    <td>{{ $data->idNo }}</td>
                    <td><a href="{{route('clinician.show',$data->id)}}">{{ $data->fullName() }}</a></td>
                    <td>{{ $data->age }}</td>
                    <td>{{ $data->phoneNumber }}</td>
                    <td>
                        <a href="{{route('clinician.show',$data->id)}}" class="btn btn-success">Treat</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection

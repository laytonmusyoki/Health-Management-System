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
    <div class="breadcrumb-title pe-3">{{$patient->patientName}}</div>
</div>
<!--end breadcrumb-->

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-title bg-primary text-white"  style="padding: 10px;">
                Appointment
            </div>
            <div class="card-body">
                <p>Patient name : <span>{{$patient->patientName}}</span></p>
                <p>Email : <span>{{$patient->email}}</span></p>
                <p>Phone No : <span>{{$patient->phone}}</span></p>
                <p>Date : <span>{{$patient->date}}</span></p>
                <p>Time : <span>{{$patient->time}}</span></p>
                <p>Reason : <span>{{$patient->reason}}</span></p>
            </div>

        </div>
    </div>
    <div class="col-lg-4">
        <div class="card-title bg-success text-white"  style="padding: 10px;">
            Update status
        </div>
        <div class="card">
            <div class="card-body">
                <form action="{{route('clinician.appointments.update',$patient)}}" method="post">
                    @csrf
                    @method('put')
                    <label for="">Status</label>
                    <select name="status" class="form-select" id="">
                        <option value="" selected disabled>Choose status</option>
                        <option value="Pending" {{old('status',$patient->status )== "Pending" ? "selected" : ""}}>Pending</option>
                        <option value="Approved" {{old('status',$patient->status) == "Approved" ? "selected" : ""}}>Approved</option>
                        <option value="Cancelled" {{old('status',$patient->status) == "Cancelled" ? "selected" : ""}}>Cancelled</option>
                    </select>
                    <button type="submit" class="btn btn-primary " style="margin-top: 10px">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>



<x-sweet-alert></x-sweet-alert>



@endsection

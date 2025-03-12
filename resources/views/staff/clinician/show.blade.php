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
    <div class="breadcrumb-title pe-3">{{$patient->patient->fullName()}}</div>
</div>
<!--end breadcrumb-->

<div class="row">
    <div class="col-lg-3">
        <div class="card">
            <div class="card-title" style="background:rgb(106, 106, 244); padding: 10px; color: white; font-weight: bold; ">
                Triage Data
            </div>
            <div class="card-body">
                <p style="font-size: 20px;">Temperature: <span style="font-size: 15px;">{{ $patient->temperature }}'C</span></p>
                <p style="font-size: 20px;">Pressure: <span style="font-size: 15px;">{{ $patient->pressure }}mmHg</span></p>
                <p style="font-size: 20px;">Height: <span style="font-size: 15px;">{{ $patient->height }}cm</span></p>
                <p style="font-size: 20px;">Weight: <span style="font-size: 15px;">{{ $patient->weight }}Kg</span></p>
            </div>
        </div>
    </div>
    <div class="col-lg-9">
        <div class="card">
            <div class="card-title" style="background:rgb(69, 202, 69); padding: 10px; color: white; font-weight: bold; ">
                Treatment
            </div>
            <div class="card-body">
               <form action="{{route('clinician.store')}}" method="post">
                @csrf
                <div class="mb-3">
                    <textarea name="signs" class="form-select" placeholder="Enter the signs and symptoms"  id="textArea"></textarea>
                    <p>Characters <span id="charCount">0</span></p>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <input type="text" hidden name="patient_id" value="{{$patient->patient_id}}">
                            <label for="" style="width: 100%;font-weight: bold;">Disease</label>
                            <input type="text" class="form-control" style="width: 100%; border-radius: 10px; padding: 10px;" name="disease" placeholder="Enter the disease">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="" style="width: 100%;font-weight: bold;">Medicine</label>
                            <input type="text" class="form-control" style="width: 100%; border-radius: 10px; padding: 10px;" name="medicine" placeholder="Enter the medicine">
                        </div>
                    </div>
                </div>
                <div class="button">
                    <button class="btn btn-success" type="submit">Submit</button>
                </div>
               </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card-title" style="background:rgb(44, 43, 43); padding: 10px; color: white; font-weight: bold; ">
            @if($result == null)
            Send a lab request
            @else
            Lab Results
            @endif
        </div>
        <div class="card">
            <div class="card-body">
                @if($result == null)
                <form action="{{route('clincian.labTest')}}" method="post">
                    @csrf
                    <div class="mb-3">
                        <input type="text" name="patient_id" value="{{$patient->patient_id}}" hidden>
                        <label for="" style="width: 100%;font-weight: bold;">Test</label>
                        <textarea name="test" placeholder="Enter the type of test" class="form-control" id="textAreas"></textarea>
                        <p>Characters <span id="charCounts">0</span> </p>
                    </div>
                    <div class="button">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </form>
                @else
                <h3>Test:{{$result->test}}</h3>
                <p>Result: {{$result->results}}</p>
                @endif
            </div>
        </div>
    </div>
</div>
<x-sweet-alert></x-sweet-alert>

<script>
    const textArea = document.getElementById('textArea');
    const charCount = document.getElementById('charCount');

    const textAreas = document.getElementById('textAreas');
    const charCounts = document.getElementById('charCounts');


    textArea.addEventListener('input',function(){
        charCount.textContent = textArea.value.length;
    })
    textAreas.addEventListener('input',function(){
        charCounts.textContent = textAreas.value.length;
    })
</script>
@endsection

@extends('staff.app')
@section('title', 'Users')
@section('content')

<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">{{$patient->user->fullName()}}</div>
</div>
<!--end breadcrumb-->

<div class="row">
    <div class="col-lg-12">
        <div class="card-title" style="background:rgb(44, 43, 43); padding: 10px; color: white; font-weight: bold; ">
            Lab Data
        </div>
        <div class="card">
            <div class="card-body">
                <form action="{{route('lab.store')}}" method="post">
                    @csrf
                    <div class="mb-3">
                        <input type="text" name="patient_id" value="{{$patient->patient_id}}" hidden>
                        <label for="" style="width: 100%;font-weight: bold;">Test</label>
                        <textarea name="test" placeholder="Enter the type of test" class="form-control" id="textAreas" readonly>{{$patient->test}}</textarea>
                        <p>Characters <span id="charCounts">0</span> </p>
                    </div>
                    <div class="mb-3">
                        <label for="" style="width: 100%;font-weight: bold;">Results</label>
                        <textarea name="results" placeholder="Enter the results" class="form-control" id="textAreas" ></textarea>
                    </div>
                    <div class="button">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

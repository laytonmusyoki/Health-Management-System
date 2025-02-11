@extends('staff.app')
@section('title','Find')
@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="mb-3">
            <label for="age" class="form-label">Id or Name</label>
            <input class="form-control" type="text"  name="search" placeholder="Search" style="width:80%;">
        </div>
    </div>
    <div class="col-lg-6">
        <a href="{{route('registrationForm')}}" class="card-link">
            <div class="card" style="width: 18rem;height: auto;">
            <div class="card-body">
                <h5 class="card-text" style="color: blue;font-size: 20px;">Register patient</h5>
            </div>
            </div>
        </a>
    </div>
</div>
@endsection
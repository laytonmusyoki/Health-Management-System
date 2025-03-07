@extends('staff.app')
@section('title','Find')
@section('content')
<div class="registration" style="display: flex; align-items: center; justify-content: space-between;">
    <div class="mb-3" style="width: 50%;">
        <label for="age" class="form-label">Id or Name</label>
        <input class="form-control" type="text" id="search"  name="search" placeholder="Search patient..." style="width:80%;">
    </div>
    <div class="register" style="width: 40%; padding: 10px; text-align: center; border-radius: 10px;">
        <a href="{{route('registrationForm')}}" class="">
            <h5 class="card-text" style="color: blue;font-size: 20px;"> <img height="30" width="30" src="{{ asset('images/edit.png') }}" alt=""> Register patient</h5>
        </a>
    </div>
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
                @foreach ($patients as $patient )
            <tr data-patient="{{ $patient->idNo }} {{ $patient->fullName() }} {{ $patient->phoneNumber }} {{ $patient->age }}">   
                    <td>{{ $patient->idNo }}</td>
                    <td>{{ $patient->fullName() }}</td>
                    <td>{{ $patient->age }}</td>
                    <td>{{ $patient->phoneNumber }}</td>
                    <td>
                        @if($patient->status=="Registered")
                        <a href="{{ route('registerQueue',$patient->id) }}" class="btn btn-success">Queue Patient</a>
                        @else
                        <a class="btn btn-primary">{{ $patient->status }}</a>
                        @endif
                    </td>
                </tr>                    
                @endforeach
            </tbody>
        </table>
    </div>
</div>


<script>
    document.getElementById('search').addEventListener('input', function(){
        let search = this.value.toLowerCase();
        let rows = document.querySelectorAll('tbody tr');
        rows.forEach(row => {
            let patient = row.getAttribute('data-patient').toLowerCase();
            if(patient.includes(search)){
                row.style.display = '';
            }else{
                row.style.display = 'none';
            }
        });
    });
</script>


@endsection
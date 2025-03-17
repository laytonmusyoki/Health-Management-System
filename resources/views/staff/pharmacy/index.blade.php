@extends('staff.app')

@section('content')
<div class="container">
    <h2>Dispense Drug</h2>

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
                        @foreach ($labPatient as $data )
                        <tr>
                            <td>{{ $data->idNo }}</td>
                            <td><a href="{{route('pharmacy.show',$data->id)}}">{{ $data->fullName() }}</a></td>
                            <td>{{ $data->age }}</td>
                            <td>{{ $data->phoneNumber }}</td>
                            <td>
                               <a href="{{route('pharmacy.show',$data->id)}}" class="btn btn-success">Dispense</a>
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

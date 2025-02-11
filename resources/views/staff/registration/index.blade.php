@extends('staff.app')
@section('title','Module')
@section('content')
<a href="{{route('find')}}" class="card-link">
    <div class="card" style="width: 18rem;height: auto;">
      <div class="card-body">
        <h5 class="card-title">Find or Register patient</h5>
      </div>
    </div>
  </a>
@endsection
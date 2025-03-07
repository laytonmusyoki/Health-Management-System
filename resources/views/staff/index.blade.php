@extends('staff.app')

@section('title','Dashboard')

@section('content')


<div class="card-row">
    @foreach ($filteredModules as $module)
    <div class="card-col">
        <div class="card">
            <a href="{{ route($module['route']) }}">
                <div class="card-body custom">
                    <div class="image">
                        <img src="{{asset('images/'.$module['image'])}}" width="50" class="img-fluid" alt="">
                    </div>
                    <h6 class="card-title">{{$module['name']}}</h6>
                </div>
            </a>
        </div>
    </div>
    @endforeach
</div>

    
@endsection
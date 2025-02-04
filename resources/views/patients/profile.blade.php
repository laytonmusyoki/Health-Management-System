@extends('patients.app')

@section('title','Dashboard')

@section('content')

<style>
    input{
        width: 100%;
        height: 50px;
        outline: none;
        border-radius: 5px;
        padding-left: 8px;
        border: 1px solid black;
    }
    input:focus{
        outline: 1px solid blue;
    }
</style>

<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">  
        My Profile  
    </div>

</div>
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('profile.update') }}" method="post">
                    @csrf
                    <div class="mb-3">
                    <label for="name">Full Name</label>
                    <input type="text" name="name"  placeholder="Enter your full name" value="{{ auth()->user()->name }}" required>
                        </div>
                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="email" name="email"  placeholder="Enter your email" value="{{ auth()->user()->email }}" readonly>
                    </div>
                    <button class="btn btn-primary" type="submit">Update</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <form action="{{route('profile.updatepassword')}}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="password">Old Password</label>
                        <input type="password" id="password" name="oldpassword"  placeholder="Create a password" required>
                    </div>
                    <div class="mb-3">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password"  placeholder="Create a password" required>
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" id="passwords" name="password_confirmation"  placeholder="Confirm your password" required>
                    </div>
                    <button class="btn btn-primary" style="float:right;" type="submit">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('2step.upate') }}" method="post">
                    @csrf
                    <h3>Two-Step-Verification</h3>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="enable2FA"
                                name="enable2FA" 
                                {{ auth()->user()->otp_enabled ? 'checked' : '' }}>
                        <label class="form-check-label" for="enable2FA">Enable Two-Step Verification</label>
                        </div>
                        <button class="btn btn-primary" type="submit">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
    
@endsection
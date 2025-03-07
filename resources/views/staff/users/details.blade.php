@extends('staff.app')
@section('content')
<div class="card shadow-lg mx-4 ">
    <div class="card-body p-3">
        <div class="row gx-4">
            <div class="col-auto">
                <div class="avatar avatar-xl position-relative">
                    <img src="{{ asset ('assets/icon.png')}}" alt="profile_image"
                        class="w-100 border-radius-lg shadow-sm" height="50px">
                </div>
            </div>
            <div class="col-auto my-auto">
                <div class="h-100">
                    <h5 class="mb-1">
                        {{ $user->first_name ?? 'Firstname' }} {{ $user->last_name ?? 'Lastname'}} ( {{$user->role}})
                    </h5>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form role="form" method="POST" action="{{ route('users.update', $user->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <p class="text-uppercase text-sm">User Information</p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">First name</label>
                                    <input class="form-control" type="text" name="first_name"
                                        value="{{$user->first_name }}">
                                    @error('first_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Last name</label>
                                    <input class="form-control" type="text" name="last_name"
                                        value="{{$user->last_name }}">
                                    @error('last_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Email address</label>
                                    <input class="form-control" type="email" name="email" value="{{$user->email }}">
                                    @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Phone</label>
                                    <input class="form-control" type="text" name="phone_number"
                                        value="{{$user->phone_number }}">
                                    @error('phone_number')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Role</label>
                                    <select class="form-control" name="role">
                                        @foreach($roles as $role)
                                        <option value="{{ $role->name }}" {{ $user->role == $role->name ? 'selected' :
                                            '' }}>{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('role')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                            </div>

                            <div class="col-md-12 mt-5">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Select Department</label>
                                    <hr>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="select-all">
                                        <label class="form-check-label" for="select-all">
                                            All Departments
                                        </label>
                                    </div>
                                    <hr>
                                    @foreach($departments as $department)
                                    <div class="form-check">
                                        <input class="form-check-input checkbox" type="checkbox"
                                            @if(in_array($department->id,$selected_departments)) checked @endif
                                        value="{{$department->id}}" id="flexCheckDefault{{$department->id}}"
                                        name="departments[]" >
                                        <label class="form-check-label" for="flexCheckDefault{{$department->id}}">
                                            {{$department->name}}
                                        </label>
                                    </div>
                                    @endforeach


                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success">Update</button>
                                </div>
                            </div>
                        </div>

                </form>
                <form role="form" method="POST" action="{{ route('password.update') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="email" value="{{ $user->email }}">
                    <hr class="horizontal dark">
                    <div class="d-flex align-items-center">
                        <p class="mb-0">Password Settings</p>
                        <button type="submit" class="btn btn-success btn-sm ms-auto">Update</button>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Old Password</label>
                                <input class="form-control" type="password" name="old-password">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">New Password</label>
                                <input class="form-control" type="password" name="password">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Confirm Password</label>
                                <input class="form-control" type="password" name="confirm-password">
                            </div>
                        </div>
                    </div>
            </div>
            </form>
        </div>
    </div>
</div>
</div>
<script>
    $(document).ready(function() {
    // When "Select All" is clicked
    $('#select-all').click(function() {
        // Check or uncheck all checkboxes based on "Select All" state
        $('.checkbox').prop('checked', this.checked);
    });
        });
</script>
@endsection

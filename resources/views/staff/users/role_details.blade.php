
@extends('staff.app')
@section('title', )
@section('content') 

<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">
           Roles
          </div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page"> 
                                    Role Details
                    Role Details
                                </li>
							</ol>
						</nav>
					</div>
					
				</div>
				<!--end breadcrumb-->
      

        <div class="card">
          <div class="card-body">
              <div class="d-flex flex-lg-row flex-column align-items-start align-items-lg-center justify-content-between gap-3">
                 <div class="flex-grow-1">
                   <h4 class="fw-bold">
                      {{ $role->name }}
                   </h4>
                   <p class="mb-0">Permissions <a href="javascript:;">
                      ({{ $role->permissions->count() }})
                   </a></p>
                 </div>
                 <div class="overflow-auto">
                 
                </div>
              </div>
          </div>
        </div>

         <div class="row">
            <div class="col-12 col-lg-12 d-flex">
               <div class="card w-100">
                <div class="card-body">
                  <h5 class="mb-3 fw-bold">Permissions<span class="fw-light ms-2">
                    ({{ $role->permissions->count() }})
                  </span></h5>
                  <form action="{{ route('roles.update', $role->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                  
                        <div>
                            <input type="checkbox" id="selectAll" onclick="toggleAll(this)">
                            <label for="selectAll">Select All</label>
                        </div>
                        <div class="row">
                            @foreach ($permissions as $permission)
                                <div class="col-lg-6">
                                    <div class="form-check">
                                        <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                            class="form-check-input" id="permission{{ $permission->id }}"
                                            {{ $role->permissions->contains($permission->id) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="permission{{ $permission->id }}">
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-3">
                        <button type="submit" class="btn btn-success">Update Permissions</button>
                    </div>
                </form>
                 
                </div>
               </div>
            </div>
        
           </div>




       

           <script>
            function toggleAll(source) {
        checkboxes = document.getElementsByName('permissions[]');
        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = source.checked;
        }
    }
    </script>
    
     





    @endsection
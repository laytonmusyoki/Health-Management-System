@extends('staff.app')
@section('content')
    <div class="container-fluid py-4">
            <div class="card">
                <div class="pb-0 p-3">
                    <div class="card-header pb-0 mb-2">
                        <h6>Permissions</h6>
                        <div class="d-flex justify-content-end mb-2">
                           <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createagency">
                                Add Permission
                            </button>                     
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table table-striped align-items-center mb-0" id="dt-basic">
                                <thead>
                            <tr>
                                <th class="text-success  ">Name</th>
                         
                                <th class="text-success text-center">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($permissions  as $item)
                                    <tr>
                                       
                                        <td>
                                            <p class="">{{$item->name}}   </p>
                                        </td>
                                     
                                
                                
                                    
                                        <td class="align-middle text-center">
                                           
                                         
                                            <a class="btn btn-success btn-xs font-weight-bold text-xs mb-0 edit" data-id="{{$item->id}}" data-name="{{$item->name}}" >
                                                <i class="fa fa-edit"></i> 
                                            </a>
                                            <a class="btn btn-danger btn-xs font-weight-bold text-xs mb-0 delete" data-id="{{$item->id}}">
                                                <i class="fa fa-trash"></i> 
                                            </a>
                                        </td>
                                    </tr>   
                                @endforeach

                            
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Create FAQ Modal -->
            <div class="modal fade" id="createagency" tabindex="-1" role="dialog" aria-labelledby="createHeroSlide" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                    <div class="modal-content">
                    <div class="modal-body p-0">
                            <div class="card card-plain">
                                <div class="card-header pb-0 text-left">
                                    <h3 class="font-weight-bolder text-success text-gradient">Add Permission</h3>
                                </div>
                                <div class="card-body pb-3">
                                    <form role="form text-left" method="post" action="{{ route('permissions.store') }}" enctype="multipart/form-data">
                                        @csrf

                                  

                                        <label for="name">Name</label>
                                        <input type="name" name="name"  class="form-control" placeholder="Enter Name">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror


                                        



                                        
                                        <div class="text-center">
                                            <button type="submit" class="btn bg-gradient-success btn-lg btn-rounded w-100 mt-4 mb-0">Save</button>
                                        </div>
                                    </form>
                                </div>
                        
                            </div>
                        </div>
                    </div>
                </div>
            </div>
             <!-- Delete Slide Modal -->
            <div class="modal fade" id="deleteHero" tabindex="-1" role="dialog" aria-labelledby="deleteHeroSlide" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Deleting...</h4>
                            <span class="close" style="cursor: pointer" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa-solid fa-circle-xmark"></i>
                            </span>
                        </div>
                        <form class="form-horizontal" method="POST" action="{{ route('permissions.delete')}}">
                            @csrf
                            @method("DELETE")
                            <div class="modal-body">
                                <input type="hidden" class="sid" name="id">
                                <div class="text-center">
                                    <h2 class="bold catname"></h2>
                                    <p>
                                        Are you sure you want to delete this slide?
                                        <br>
                                        <span class="text-danger">This action cannot be reversed!</span>
                                    </p>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between pb-0">
                            <button type="button" class="btn btn-sm btn-success btn-flat pull-left" data-bs-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>
                                <button type="submit" class="btn btn-sm btn-danger btn-flat" name="delete"><i class="fa fa-trash"></i> Delete</button>                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <!-- End Delete Slide Modal -->
      </div>

      <!-- Edit FAQ Modal -->
    <div class="modal fade" id="editfaq" tabindex="-1" role="dialog" aria-labelledby="editFaqModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="card card-plain">
                        <div class="card-header pb-0 text-left">
                            <h3 class="font-weight-bolder text-success text-gradient">Edit Permission</h3>
                        </div>
                        <div class="card-body pb-3">
                            <form role="form text-left" method="post" action="{{ route('permissions.update', $item->id)}}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="id" id="id">
                                <label>Name</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name">
                                
                                
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success btn-lg btn-rounded w-100 mt-4 mb-0">Update</button>
                                </div>
                            </form>
                        </div>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Edit FAQ Modal -->

   



    <script>
           $(function(){
            $(document).on('click', '.delete', function(e){
                e.preventDefault();
                $('#deleteHero').modal('show');
                var id = $(this).data('id');
                $('.sid').val(id);
            });    
        });
        $(document).on('click', '.edit', function(e) {
            e.preventDefault();
            $('#editfaq').modal('show');
            var id = $(this).data('id');
            var name = $(this).data('name');



            $('#name').val(name);
            $('#id').val(id);
        });
      
    </script>
@endsection

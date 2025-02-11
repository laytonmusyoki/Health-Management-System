@extends('staff.app')
@section('title', 'Users')
@section('content')

<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Users</div>
</div>
<!--end breadcrumb-->

<div class="product-count d-flex align-items-center gap-3 gap-lg-4 mb-4 fw-medium flex-wrap font-text1">
    <a href="javascript:;"><span class="me-1">All</span><span class="text-secondary">( {{ $users->count() }} )</span></a>
</div>

<div class="row g-3">
    <div class="col-auto flex-grow-1 overflow-auto">
        <div class="btn-group position-static"></div>
    </div>
    <div class="col-auto">
        <div class="d-flex align-items-center gap-2 justify-content-lg-end">
            <button type="button" class="btn btn-primary px-4" data-bs-toggle="modal" data-bs-target="#exampleScrollableModal">
                <i class="bi bi-plus-lg me-2"></i>Add User
            </button>
        </div>
    </div>
</div><!--end row-->

<div class="card mt-4">
    <div class="card-body">
        <div class="product-table">
            <div class="table-responsive white-space-nowrap" style="min-height: 500px !important;">
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $item)
                        <tr>
                            <td>{{ $item->username ?? 'N/A' }} {{ $item->last_name ?? 'N/A' }}</td>
                            <td>{{ $item->email }}</td>
                            <td>
                                @foreach($item->roles as $role)
                                <span class="badge bg-primary">{{ $role->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-filter dropdown-toggle dropdown-toggle-nocaret" type="button" data-bs-toggle="dropdown">
                                        <i class="bi bi-three-dots"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item edit-btn" href="javascript:void(0);" data-id="{{ $item->id }}" data-username="{{ $item->name }}" data-email="{{ $item->email }}" data-role="{{ $item->role }}">
                                                <i class="bi bi-pencil-square me-2"></i>Edit
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item delete-btn" data-id="{{ $item->id }}" href="javascript:void(0);">
                                                <i class="bi bi-trash me-2"></i>Delete
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Add User Modal -->
<div class="modal fade" id="exampleScrollableModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" id="username" placeholder="Enter Username" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email" required>
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select name="role" class="form-control" id="role" required>
                            <option value="">Select Role</option>
                            @foreach ($roles as $role)
                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Enter Password" required>
                    </div>
                </div>
                <div class="modal-footer justify-content-end">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editUserForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_username" class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" id="edit_username" placeholder="Enter Username" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="edit_email" placeholder="Enter Email" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_role" class="form-label">Role</label>
                        <select name="role" class="form-control" id="edit_role" required>
                            <option value="">Select Role</option>
                            @foreach ($roles as $role)
                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_password" class="form-label">Password (Leave blank to keep current password)</label>
                        <input type="password" name="password" class="form-control" id="edit_password" placeholder="Enter New Password">
                    </div>
                </div>
                <div class="modal-footer justify-content-end">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle edit button clicks
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', function() {
                const userId = this.getAttribute('data-id');
                const username = this.getAttribute('data-username');
                const email = this.getAttribute('data-email');
                const role = this.getAttribute('data-role');

                // Set the form action URL
                document.getElementById('editUserForm').action = `/admin/users/${userId}`;

                // Populate the form fields
                document.getElementById('edit_username').value = username;
                document.getElementById('edit_email').value = email;
                document.getElementById('edit_role').value = role;

                // Show the modal
                const editModal = new bootstrap.Modal(document.getElementById('editUserModal'));
                editModal.show();
            });
        });

        // Handle delete button clicks
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function() {
                const userId = this.getAttribute('data-id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const form = document.createElement('form');
                        form.action = `/admin/users/${userId}`;
                        form.method = 'POST';

                        form.innerHTML = `
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="DELETE">
                        `;

                        document.body.appendChild(form);
                        form.submit();
                    }
                });
            });
        });
    });
</script>

@endsection
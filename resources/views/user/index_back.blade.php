@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row p-1rem">
            <div class="card pb-2">
                <h5 class="card-header">User Table</h5>
                <div class="table-responsive text-nowrap overflow-x-hidden">
                    <table class="table" id="userTableId" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>User Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- user edit modal:start --}}
    <div class="modal fade" id="editUserinfo" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userinfoTitle">Update User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('user.update')}}" method="POST" id="userUpdateForm">
                    @method('PUT')
                    @csrf
                    <div class="modal-body">
                        <input  name="id" id="id" />
                        <div class="row g-2">
                            <div class="col mb-0">
                                <label for="name" class="form-label required">Name</label>
                                <input type="text" id="name" required class="form-control" name="name" placeholder="Enter Name" />
                            </div>
                            <div class="col mb-0">
                                {{-- email --}}
                                <label for="email" class="form-label required">Email</label>
                                <input type="email" id="email" required class="form-control" name="email" placeholder="Enter Email" />
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col mb-0">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" id="password" class="form-control" name="password" placeholder="Enter Password" />
                            </div>
                            <div class="col mb-0">
                                <label for="confirmPassword" class="form-label">Confirm Password</label>
                                <input type="password" id="confirmPassword" class="form-control" name="confirmPassword"
                                    placeholder="Enter Confirm Password" />
                            </div>
                        </div>
                        {{-- role --}}
                        <div class="row g-2">
                            <div class="col mb-0">
                                <label for="role" class="form-label required">Role</label>
                                <select id="role" required class="form-select" name="role">
                                    <option value="super-admin">Super Admin</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- user edit modal:end --}}
@endsection


{{-- scripts --}}
@push('scripts')
    <script>
        $(document).ready(function() {

            url = '/user';
            table = $('#userTableId').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: url,
                columns: [{
                        render: function(data, type, row) {
                            return row.DT_RowIndex;
                        },
                        targets: 0,
                    },
                    {
                        render: function(data, type, row) {
                            return row.name;
                        },
                        targets: 0,
                    },
                    {
                        render: function(data, type, row) {
                            return row.email;
                        },
                        targets: 0,
                    },
                    {
                        render: function(data, type, row) {
                            // <span class="badge bg-label-primary">Primary</span>
                            var role = '';
                            row.role == 'super-admin'? role = `<span class="badge bg-label-success">Super Admin</span>` :
                            role = `<span class="badge bg-label-primary">Admin</span>`;
                            return role;
                        },
                        targets: 0,
                    },
                    {
                        render: function(data, type, row) {
                            return row.status;
                        },
                        targets: 0,
                    },
                    {
                        render: function(data, type, row) {
                            return `<div>
                                    <span class="btn btn-primary btn-sm" onClick="editUserInfoBtn(${row.id})">
                                        <i class='bx bx-edit-alt'></i>
                                    </span>
                                    <span class="btn btn-danger btn-sm deteleBtn" onClick="deteleBtn(${row.id})">
                                        <i class='bx bxs-trash-alt'></i>
                                    </span>
                                </div>`;
                        },
                        targets: 0,
                    }
                ]
            });





        });


        const deteleBtn = (id) => {
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
                    $.ajax({
                        url: `/user/${id}`,
                        type: 'DELETE',
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            table.ajax.reload();
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                        }
                    });
                }
            });
        };

        const editUserInfoBtn = (id) => {
            $('#editUserinfo').modal('show');
            $("#userUpdateForm").attr('action', `/user/${id}/update`);
            axios.get(`/user/fetch/${id}`)
                .then(response => {
                    const data = response.data.data;
                    $('#name').val(data.name);
                    $('#email').val(data.email);
                    $('#role').val(data.role);
                    $('#password').val('');

                })
                .catch(error => {
                    console.log(error);
                });
        };
    </script>
@endpush

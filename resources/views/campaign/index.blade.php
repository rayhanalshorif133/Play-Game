@extends('layouts.app')

@section('content')
    <div class="px-3 container-p-y">
        <div class="row p-1rem">
            <div class="card">

                <div class="d-flex justify-content-between px-2">
                    <h5 class="card-header">Campaigns List</h5>
                    <button class="btn btn-primary btn-sm d-block d-flex my-2 createNewUser" data-bs-toggle="modal"
                        data-bs-target="#createNewUserinfo">Add User</button>
                </div>
                <div class="table-responsive overflow-x">
                    <table class="table table-striped" id="campaignsTableId">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Start Date & Time</th>
                                <th scope="col">End Date & Time</th>
                                <th scope="col">Status</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            var url = '/admin/campaigns';
            $('#campaignsTableId').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: url,
                columns: [{
                        render: function(data, type, row) {
                            return row.DT_RowIndex;
                        },
                        targets: 0,
                        className: 'fit-content' // Add a custom class
                    },
                    {
                        render: function(data, type, row) {
                            return row.name;
                        },
                        targets: 0,
                        className: 'fit-content' // Add a custom class
                    },
                    {
                        render: function(data, type, row) {
                            return row.amount + ' tk';
                        },
                        targets: 0,
                        className: 'fit-content' // Add a custom class
                    },
                    {
                        render: function(data, type, row) {
                            const formattedDateTime = moment(row.start_date_time).format(
                                "DD-MM-YYYY HH:mm:ss");
                            return formattedDateTime;
                        },
                        targets: 0,
                        className: 'fit-content' // Add a custom class
                    },
                    {
                        render: function(data, type, row) {
                            const formattedDateTime = moment(row.end_date_time).format(
                                "DD-MM-YYYY HH:mm:ss");
                            return formattedDateTime;
                        },
                        targets: 0,
                        className: 'fit-content' // Add a custom class
                    },
                    {
                        render: function(data, type, row) {
                            const status = row.status;
                            if (status == 1) {
                                return `<span class="badge bg-label-success cursor-pointer " onClick="handleStatus(${row.id})">Active</span>`; // Customize the style as needed
                            } else {
                                return `<span class="badge bg-label-danger cursor-pointer" onClick="handleStatus(${row.id})">Inactive</span>`; // Or any other status representation
                            }
                        },
                        targets: 0,
                        className: 'fit-content' // Add a custom class
                    },
                    {
                        render: function(data, type, row) {
                            return '<button type="button" class="btn btn-sm btn-primary">Edit</button>';
                        },
                        targets: 0,
                        className: 'fit-content' // Add a custom class
                    }
                ],
            });
        });


        const handleStatus = (id) => {
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to change this campaign's status..!!!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, change it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.put(`/admin/campaigns/?type=status&id=${id}`)
                        .then(response => {
                            console.log(response.data)
                            const status = response.data.status;
                            const message = response.data.message;
                            if (status == false) {
                                Swal.fire({
                                    icon: "error",
                                    title: "Oops...",
                                    text: message,
                                });
                                return false;
                            }
                            Swal.fire(
                                'Updated!',
                                'Campaign has been updated.',
                                'success'
                            );
                            $('#campaignsTableId').DataTable().ajax.reload();
                        })
                        .catch(error => {
                            console.log(error);
                        });
                }
            });
        };
    </script>
@endpush

@extends('layouts.app')

@section('content')
    <div class="px-3 container-p-y">
        <div class="row p-1rem">
            <div class="card">
                <div class="d-flex justify-content-between px-2">
                    <h5 class="card-header">Campaigns List</h5>
                    <button class="btn btn-primary btn-sm d-block d-flex my-2" data-bs-toggle="modal"
                        data-bs-target="#createCampainsModal">Add Campaign</button>
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


        <!-- Modal -->
        <div class="modal fade" id="createCampainsModal" tabindex="-1" aria-labelledby="createCampainsModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createCampainsModalLabel">Add New Campaigns</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="createCampaignForm">
                            <input type="text" class="form-control d-none" id="create_campaignID">
                            <div class="mb-3">
                                <label for="create_campaignName" class="form-label">Name</label>
                                <input type="text" class="form-control" id="create_campaignName" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="create_campaignAmount" class="form-label">Amount</label>
                                <input type="number" class="form-control" id="create_campaignAmount" name="amount"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="create_startDateTime" class="form-label">Start Date & Time</label>
                                <input type="datetime-local" class="form-control" id="create_startDateTime"
                                    name="start_date" required>
                            </div>
                            <div class="mb-3">
                                <label for="create_endDateTime" class="form-label">End Date & Time</label>
                                <input type="datetime-local" class="form-control" id="create_endDateTime" name="end_date"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="createCampaignStatus" class="form-label">Status</label>
                                <select class="form-select" id="createCampaignStatus" required>
                                  <option value="1">Active</option>
                                  <option value="0">Inactive</option>
                                </select>
                              </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="handleCreateSubmit()"
                            data-bs-dismiss="modal">Create</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="updateCampainsModal" tabindex="-1" aria-labelledby="updateCampainsModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateCampainsModalLabel">Update Campaigns</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="updateCampaignForm">
                            <input type="text" class="form-control d-none" id="update_campaignID">
                            <div class="mb-3">
                                <label for="update_campaignName" class="form-label">Name</label>
                                <input type="text" class="form-control" id="update_campaignName" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="update_campaignAmount" class="form-label">Amount</label>
                                <input type="number" class="form-control" id="update_campaignAmount" name="amount"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="update_startDateTime" class="form-label">Start Date & Time</label>
                                <input type="datetime-local" class="form-control" id="update_startDateTime"
                                    name="start_date" required>
                            </div>
                            <div class="mb-3">
                                <label for="update_endDateTime" class="form-label">End Date & Time</label>
                                <input type="datetime-local" class="form-control" id="update_endDateTime" name="end_date"
                                    required>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="handleSubmit()"
                            data-bs-dismiss="modal">Update</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            handleDataTable();
        });


        const handleDataTable = () => {
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
                            return `<button type="button" class="btn btn-sm btn-primary" onClick="updateCampaign(${row.id})">Edit</button>`;
                        },
                        targets: 0,
                        className: 'fit-content' // Add a custom class
                    }
                ],
            });
        };


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

        const updateCampaign = (id) => {
            const updateCampains = new bootstrap.Modal(document.getElementById('updateCampainsModal'));
            const form = document.getElementById('updateCampaignForm');

            axios.get(`/admin/campaigns?type=fetch&id=${id}`)
                .then((response) => {
                    const data = response.data.data;
                    console.log(data.status);
                    // Set values in the form fields
                    $('#update_campaignID').val(data.id);
                    $('#update_campaignName').val(data.name);
                    $('#update_campaignAmount').val(data.amount);
                    $('#update_campaignDescription').val(data.description);
                    $('#update_startDateTime').val(data.start_date_time);
                    $('#update_endDateTime').val(data.end_date_time);
                });

            // Retrieve form values

            updateCampains.show();
        };

        const handleCreateSubmit = () => {
            const createData = {
                name: $('#create_campaignName').val(),
                amount: $('#create_campaignAmount').val(),
                description: $('#create_campaignDescription').val(),
                start_date_time: $('#create_startDateTime').val(),
                end_date_time: $('#create_endDateTime').val(),
                status: $('#createCampaignStatus').val(),
            };


            // Send a PUT request to update the campaign
            axios.post(`/admin/campaigns`, createData)
                .then((response) => {
                    const status = response.data.status;
                    if(status == false){
                        console.log(response.data.data);
                    }else{
                        if ($.fn.DataTable.isDataTable('#campaignsTableId')) {
                            $('#campaignsTableId').DataTable().destroy(); // Destroy the existing DataTable instance
                            handleDataTable();
                        }
                    }
                })
                .catch(error => console.error('Error create campaign:', error));
        };


        const handleSubmit = () => {
            const updatedData = {
                id: $('#update_campaignID').val(),
                name: $('#update_campaignName').val(),
                amount: $('#update_campaignAmount').val(),
                description: $('#update_campaignDescription').val(),
                start_date_time: $('#update_startDateTime').val(),
                end_date_time: $('#update_endDateTime').val(),
            };

            // Send a PUT request to update the campaign
            axios.put(`/admin/campaigns?type=update`, updatedData)
                .then((response) => {
                    console.log(response.data.data);
                    if ($.fn.DataTable.isDataTable('#campaignsTableId')) {
                        $('#campaignsTableId').DataTable().destroy(); // Destroy the existing DataTable instance
                        handleDataTable();
                    }

                })
                .catch(error => console.error('Error updating campaign:', error));
        };
    </script>
@endpush

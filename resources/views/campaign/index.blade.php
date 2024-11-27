@extends('layouts.app')

@section('content')
    <div class="px-3 container-p-y">
        <div class="row p-1rem">
            <div class="card">
                <div class="d-flex justify-content-between px-2">
                    <h5 class="card-header">Campaigns List</h5>
                    <button class="btn btn-primary btn-sm d-block d-flex my-2 addCampaignBtn" data-bs-toggle="modal"
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


                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="create_startDateTime" class="form-label required">Start Date & Time</label>
                                    <input type="datetime-local" class="form-control" id="create_startDateTime"
                                        name="start_date" required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="create_endDateTime" class="form-label required">End Date & Time</label>
                                    <input type="datetime-local" class="form-control" id="create_endDateTime"
                                        name="end_date" required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="create_campaignName" class="form-label optional">Name</label>
                                    <input type="text" class="form-control" id="create_campaignName" name="name">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="create_campaignAmount" class="form-label optional">Amount</label>
                                    <input type="number" class="form-control" id="create_campaignAmount" name="amount">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="createCampaignStatus" class="form-label optional">Status</label>
                                    <select class="form-select" id="createCampaignStatus" required>
                                        <option value="1" selected>Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
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
                                <input type="text" class="form-control" id="update_campaignName" name="name">
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
                                <input type="datetime-local" class="form-control" id="update_endDateTime"
                                    name="end_date" required>
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
                            const date = moment(row.start_date).format(
                                "DD-MM-YYYY");
                            let time = moment(row.start_time, "HH:mm:ss.SSSSSS").format("HH:mm:ss");

                            return date + " " + time;
                        },
                        targets: 0,
                        className: 'fit-content' // Add a custom class
                    },
                    {
                        render: function(data, type, row) {
                            //console.log(row);
                            const date = moment(row.end_date).format(
                                "DD-MM-YYYY");
                            let time = moment(row.end_time, "HH:mm:ss.SSSSSS").format("HH:mm:ss");
                            return date + " " + time;
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
                rowCallback: function(row, data) {
                    // Add a CSS class to the row based on the `type` attribute
                    if (data.type === 'current') {
                        $(row).css({
                            'background-color': '#e9f7ef', // Light green background
                            'color': '#155724', // Dark green text
                            'font-weight': 'bold', // Bold text
                            'border-left': '10px solid #28a745', // Green border on the left
                            'transition': 'background-color 0.3s ease' // Smooth hover effect
                        }); 
                    }
                }
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
                    // Set values in the form fields
                    $('#update_campaignID').val(data.id);
                    $('#update_campaignName').val(data.name);
                    $('#update_campaignAmount').val(data.amount);
                    $('#update_campaignDescription').val(data.description);
                    let start_time = moment(data.start_time, "HH:mm:ss.SSSSSS").format("HH:mm:ss");
                    const start_date_time = data.start_date + " " + start_time;

                    let end_time = moment(data.end_time, "HH:mm:ss.SSSSSS").format("HH:mm:ss");
                    const end_date_time = data.end_date + " " + end_time;
                    $('#update_startDateTime').val(start_date_time);
                    $('#update_endDateTime').val(end_date_time);
                });

            updateCampains.show();
        };

        const handleCreateSubmit = () => {
            const createData = {
                name: $('#create_campaignName').val(),
                amount: $('#create_campaignAmount').val(),
                start_date_time: $('#create_startDateTime').val(),
                end_date_time: $('#create_endDateTime').val(),
                status: $('#createCampaignStatus').val(),
            };




            // Send a PUT request to update the campaign
            axios.post(`/admin/campaigns`, createData)
                .then((response) => {
                    const status = response.data.status;
                    if (status == false) {
                        console.log(response.data.data);
                    } else {
                        if ($.fn.DataTable.isDataTable('#campaignsTableId')) {
                            $('#campaignsTableId').DataTable().destroy(); // Destroy the existing DataTable instance
                            handleDataTable();
                        }
                    }
                })
                .catch(error => console.error('Error create campaign:', error));
        };


        $(".addCampaignBtn").click(function(event) {
            axios.get('/admin/fetch-campaigns?type=last-campaign')
                .then((response) => {
                    const data = response.data.data;
                    const start_time = moment(data.start_time, "HH:mm:ss.SSSSSS").format("HH:mm:ss");
                    const end_time = moment(data.end_time, "HH:mm:ss.SSSSSS").format("HH:mm:ss");
                    const start_date = moment(data.end_date).add(1, 'day');
                    const end_date = moment(data.end_date).add(7, 'day');

                    const start_date_time = start_date.format('YYYY-MM-DD') + " " + start_time;
                    const end_date_time = end_date.format('YYYY-MM-DD') + " " + end_time;

                    $("#create_startDateTime").val(start_date_time);
                    $("#create_endDateTime").val(end_date_time);
                })
        });


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
                    if ($.fn.DataTable.isDataTable('#campaignsTableId')) {
                        $('#campaignsTableId').DataTable().destroy(); // Destroy the existing DataTable instance
                        handleDataTable();
                    }

                })
                .catch(error => console.error('Error updating campaign:', error));
        };
    </script>
@endpush

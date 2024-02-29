$(document).ready(function() {

    var url = '/campaign-durations/1';
    $('#campaignDurationsTableID').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        orderable: true,
        order: [
            [0, 'desc']
        ],
        ajax: url,
        columns: [{
                render: function(data, type, row) {
                    return row.DT_RowIndex;
                },
                targets: 0,
                width: "auto",
            },
            {
                render: function(data, type, row) {
                    return row.name;
                },
                targets: 0,
                width: "auto",
            },
            {
                render: function(data, type, row) {
                    return row.start_date;
                },
                targets: 0,
                width: "auto",
            },
            {
                render: function(data, type, row) {
                    return row.end_date;
                },
                targets: 0,
                width: "auto",
            },
            {
                render: function(data, type, row) {
                    var status = "";
                    row.status == 'active' ? status =
                        `<span class="badge bg-success">Active</span>` :
                        status = `<span class="badge bg-danger">Inactive</span>`;
                    return status;
                },
                targets: 0,
                width: "auto",
            },
            {
                render: function(data, type, row) {
                    return `
                    <button class="btn btn-primary btn-sm" onclick="editcampaignDuration(${row.id})">
                        <i class='bx bx-edit-alt'></i>
                    </button>
                    <button class="btn btn-danger btn-sm" onclick="deleteCampaignDuration(${row.id})">
                        <i class='bx bxs-trash-alt'></i>
                    </button>
                    `;
                },
                targets: 0,
                width: "auto",
            },
        ],
    });

    createCampaignDuration();
});


const editcampaignDuration = (id) => {
    axios.get(`/campaign-durations/${id}/fetch`)
        .then((response) => {
            if (response.status === 200) {
                const data = response.data;
                console.log(data);
                // $("#id").val(data.id);
                // $("#name").val(data.name);
                // $("#start_date").val(data.start_date);
                // $("#end_date").val(data.end_date);
                // $("#status").val(data.status);
                // $("#createNewcampaignDuration").modal('show');
            }
        });
};

const createCampaignDuration = () => {
    const campaign_id = $("#GET_campaign_id").val();
    const selected_campaign = $("#GET_selected_campaign").val();
    $("#campaign_id").val(campaign_id);
    $("#selected_campaign").html(selected_campaign);
};

const deleteCampaignDuration = (id) => {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            axios.delete(`/campaign-durations/${id}`)
                .then((response) => {
                    if (response.status === 200) {
                        $("#campaignDurationsTableID").DataTable().ajax.reload();
                        Swal.fire({
                            title: "Deleted!",
                            text: "Your file has been deleted.",
                            icon: "success"
                        });
                    }else{
                        Swal.fire({
                            title: "Error!",
                            text: "Something went wrong.",
                            icon: "error"
                        });
                    }
                });
        }else{
            Swal.fire({
                title: "Cancelled!",
                text: "Your file is safe.",
                icon: "error"
            });
        }
    });
};

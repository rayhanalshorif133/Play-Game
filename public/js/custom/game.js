$(document).ready(function () {
    var url = '/admin/games';
    $('#gameTableId').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: url,
        columns: [{
            render: function (data, type, row) {
                return row.DT_RowIndex;
            },
            targets: 0,
            width: "auto",
        },
        {
            render: function (data, type, row) {
                return row.title;
            },
            targets: 1,
            width: "auto",
        },
        {
            render: function (data, type, row) {
                return row.keyword;
            },
            targets: 1,
            width: "auto",
        },
        {
            render: function (data, type, row) {
                return row.url;
            },
            targets: 1,
            width: "auto",
        },
        {
            render: function (data, type, row) {
                return row.status;
            },
            targets: 1,
            width: "auto",
        },
        {
            render: function (data, type, row) {
                return row.description;
            },
            targets: 1,
            width: "auto",
        },
        {
            render: function (data, type, row) {
                return `
                <div class="d-flex space-x-2">
                    <button class="btn btn-info btn-sm d-flex items-center" onClick="updateGame(${row.id})" data-bs-toggle="modal" data-bs-target="#update_game" data-title="${row.title}" onClick="createCampaignDuration(${row.id})">
                    <i class='bx bx-edit'></i>
                    </button>
                    <button class="btn btn-danger btn-sm d-flex items-center createCampaignDuration" data-bs-toggle="modal" data-bs-target="#delete_game" data-title="${row.title}" onClick="createCampaignDuration(${row.id})">
                    <i class='bx bxs-trash-alt'></i>
                    </button>
                </div>
                `;
            },
            targets: 1,
            width: "auto",
        },
        ],
    });
});


const updateGame = (id) => {
    try {
        axios.get(`/admin/games/${id}/fetch`)
        .then(function (response) {
            const game = response.data.data;
            $("#set_game_id").val(game.id);
            $("#update_title").val(game.title);
            $("#update_keyword").val(game.keyword);
            $("#update_url").val(game.url);
            $("#update_status").val(game.status);
            $("#update_description").val(game.description);
        })
    } catch (error) {
        
    }
};


const deleteCampaign = (id) => {
    Swal.fire({
        title: 'Are you sure?',
        text: "You want to delete this campaign?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            axios.delete(`/admin/campaigns/${id}`)
                .then(response => {
                    Swal.fire(
                        'Deleted!',
                        'Campaign has been deleted.',
                        'success'
                    );
                    $('#campaignsTableId').DataTable().ajax.reload();
                })
                .catch(error => {
                    console.log(error);
                });
        }
    });
}


const createCampaignDuration = (id) => {
    axios.get(`/admin/campaigns/fetch/${id}`)
        .then(response => {
            const campaign = response.data.data;
            $("#selected_campaign").html(campaign.title);
            $("#campaign_id").val(campaign.id);
        })
        .catch(error => {
            console.log(error);
        });
}

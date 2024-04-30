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
                return 'btns';
            },
            targets: 1,
            width: "auto",
        },
        ],
    });
});

const showCampaignDetails = (id) => {
    axios.get(`/admin/campaigns/fetch/${id}`)
        .then(response => {
            const campaign = response.data.data;
            if (campaign.thumbnail == null) {
                $("#campaign-thumbnail").html('Thumbnail image is not set...!');
            } else {
                $("#campaign-thumbnail").html(`<img src="${campaign.thumbnail}" alt="thumbnail" class="img-fluid h-13">`);
            }

            if (campaign.banner == null) {
                $("#campaign-banner").html('Banner image is not set...!');
            } else {
                $("#campaign-banner").html(`<img src="${campaign.banner}" alt="banner" class="img-fluid h-13">`);
            }
            $("#campaign-title").html(`<span class="text-bolder">Title: </span>${campaign.title}`);
            var typeBg = campaign.type == 'game' ? 'bg-label-info' : 'bg-label-primary';
            var type = `<span class="badge bg-label-info">${campaign.type}</span>`
            $("#campaign-type").html(`<span class="text-bolder">Type: </span> ${type}`);

            var statusBg = campaign.status == 1 ? 'bg-success' : 'bg-danger';
            var statusTitle = campaign.status == 1 ? 'Active' : 'Inactive';
            var status = `<span class="badge ${statusBg}">${statusTitle}</span>`;
            $("#campaign-status").html(`<span class="text-bolder">Status: ${status}</span>`);

            // campaign-per_question_score
            if (campaign.per_question_score == null) {
                $("#campaign-per_question_score").addClass('d-none');
            } else {
                $("#campaign-per_question_score").removeClass('d-none');
                $("#campaign-per_question_score").html(`<span class="text-bolder">Per Question Score: </span> ${campaign.per_question_score}`);
            }

            // campaign-total_questions
            if (campaign.total_questions == null) {
                $("#campaign-total_questions").addClass('d-none');
            } else {
                $("#campaign-total_questions").removeClass('d-none');
                $("#campaign-total_questions").html(`<span class="text-bolder">Total Questions: </span> ${campaign.total_questions}`);
            }

            // campaign-total_time_limit
            if (campaign.total_time_limit == null) {
                $("#campaign-total_time_limit").addClass('d-none');
            } else {
                $("#campaign-total_time_limit").removeClass('d-none');
                $("#campaign-total_time_limit").html(`<span class="text-bolder">Total Time Limit: </span> ${campaign.total_time_limit} minutes`);
            }

            // campaign-createdBy
            $("#campaign-createdBy").html(`<span class="text-bolder">Created By: </span> ${campaign.created_by.name}`);
            $("#campaign-updatedBy").html(`<span class="text-bolder">Updated By: </span> ${campaign.updated_by.name}`);

            // campaign-description
            if (campaign.description == null) {
                $("#campaign-description").addClass('d-none');
            } else {
                $("#campaign-description").removeClass('d-none');
                $("#campaign-description").html(`<span class="text-bolder">Description: </span> ${campaign.description}`);
            }
        })
        .catch(error => {
            console.log(error);
        });
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

const showCampaignDuration = (id) => {
    console.log(id);
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

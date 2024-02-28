$(document).ready(function () {
    var url = '/campaigns';
    $('#campaignsTableId').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: url,
        columns: [{
            render: function (data, type, row) {
                return row.DT_RowIndex;
            },
            targets: 0,
        },
        {
            render: function (data, type, row) {
                return row.title;
            },
            targets: 1,
        },
        {
            render: function (data, type, row) {
                type = '<span class="badge bg-label-primary">Quiz</span>';

                if (row.type == 'game') {
                    type = '<span class="badge bg-label-info">Game</span>';
                }

                return type;
            },
            targets: 1,
        },

        {
            render: function (data, type, row) {
                const name = row.created_by.name;
                return name;
            },
            targets: 1,
        },
        {
            render: function (data, type, row) {
                var status = "";
                row.status == 'active' ? status = `<span class="badge bg-success">Active</span>` :
                    status = `<span class="badge bg-danger">Inactive</span>`;
                return status;
            },
            targets: 0,
        },
        {
            render: function (data, type, row) {
                return `<span onClick="showCampaignDetails(${row.id})" data-bs-toggle="modal" data-bs-target="#showDetailsCampaign" class="btn btn-primary btn-sm"><i class='bx bx-show'></i></span>
                             <a href="/campaigns/${row.id}/edit" class="btn btn-warning btn-sm"><i class='bx bx-edit-alt'></i></a>
                             <button class="btn btn-danger btn-sm" onclick="deleteCampaign(${row.id})"><i class='bx bxs-trash-alt'></i></button>`;
            },
            targets: 0,
        },
        ],
    });
});

const showCampaignDetails = (id) => {
    axios.get(`/campaigns/fetch/${id}`)
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

            var statusBg = campaign.status == 'active' ? 'bg-success' : 'bg-danger';
            var status = `<span class="badge ${statusBg}">${campaign.status}</span>`;
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
        })
        .catch(error => {
            console.log(error);
        });
};

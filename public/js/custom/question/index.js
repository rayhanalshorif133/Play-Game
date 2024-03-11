$(document).ready(function () {
    var url = window.location.pathname;
    $('#questionsTableId').DataTable({
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
                const GETCorrectOption = row.correct_option;
                var correctOption = "";
                if(GETCorrectOption == 'option_a'){
                    correctOption = row.option_a;
                }else if(GETCorrectOption == 'option_b'){
                    correctOption = row.option_b;
                }else if(GETCorrectOption == 'option_c'){
                    correctOption = row.option_c;
                }else if(GETCorrectOption == 'option_d'){
                    correctOption = row.option_d;
                }
                return correctOption;
            },
            targets: 1,
            width: "auto",
        },
        {
            render: function (data, type, row) {
                const name = row.created_by.name;
                return name;
            },
            targets: 1,
            width: "auto",
        },
        {
            render: function (data, type, row) {
                var status = "";
                row.status == 1 ? status = `<span class="badge bg-success">Active</span>` :
                    status = `<span class="badge bg-danger">Inactive</span>`;
                return status;
            },
            targets: 0,
            width: "auto",
        },
        {
            render: function (data, type, row) {
                return `<span onClick="showQuestionsDetails(${row.id})" data-bs-toggle="modal" data-bs-target="#showQuestionsDetails" class="btn btn-primary btn-sm"><i class='bx bx-show'></i></span>
                             <a href="/admin/questions/${row.id}/edit" class="btn btn-warning btn-sm"><i class='bx bx-edit-alt'></i></a>
                    <button class="btn btn-danger btn-sm" onclick="deleteCampaign(${row.id})"><i class='bx bxs-trash-alt'></i></button>`;
            },
            targets: 0,
            width: "auto",
        },
        ],
    });
});


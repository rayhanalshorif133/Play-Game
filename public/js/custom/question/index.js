
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
                if (GETCorrectOption == 'option_a') {
                    correctOption = row.option_a;
                } else if (GETCorrectOption == 'option_b') {
                    correctOption = row.option_b;
                } else if (GETCorrectOption == 'option_c') {
                    correctOption = row.option_c;
                } else if (GETCorrectOption == 'option_d') {
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


// showQuestionsDetails
function showQuestionsDetails(id) {
    axios.get(`/admin/questions/${id}/fetch`)
        .then((response) => {
            const data = response.data.data;
            console.log(data);
            if (data.image != null) {
                $('#question-image').html(`<img src="/${data.image}" class="img-fluid w-75" alt="Question Image">`);
            } else {
                $('#question-image').html(`<h5 class="text-start text-sm text-red">Image Not Set</h5>`);
            }

            // question-title
            $('#question-title').html(`
                <h5 class="text-start">
                    <strong>Question Title: </strong> ${data.title}
                </h5>
            `);

            const options = [
                {
                    option: 'A',
                    option_title: data.option_a,
                    is_correct: data.correct_option == 'option_a' ? true : false
                }, {
                    option: 'B',
                    option_title: data.option_b,
                    is_correct: data.correct_option == 'option_b' ? true : false
                }, {
                    option: 'C',
                    option_title: data.option_c,
                    is_correct: data.correct_option == 'option_c' ? true : false
                }, {
                    option: 'D',
                    option_title: data.option_d,
                    is_correct: data.correct_option == 'option_d' ? true : false
                }
            ];

            // data.correct_option
            const correct_option = options.find(option => option.is_correct).option_title;

            var question_options = "";

            options.forEach((item, index) => {
                if(item.option_title){
                    question_options += `<div class="col-12 col-lg-4 col-md-6 mb-1">
                        <h4 class="text-base">
                        ${item.is_correct ? '✔️' : ''}
                        ${item.option}. ${item.option_title}</h4>
                    </div>`;
                }else{
                    question_options += `<div class="col-12 col-lg-4 col-md-6 mb-1">
                        <h4 class="text-base text-red-100">${item.option}. Option Not Set</h4>
                    </div>`;
                }
            });

            $("#question_options_with_ans").html(question_options);



        });
}


// deleteCampaign
function deleteCampaign(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You want to delete this question!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
    }).then((result) => {
        if (result.isConfirmed) {
            axios.delete(`/admin/questions/${id}`)
                .then((response) => {
                    Swal.fire(
                        'Deleted!',
                        response.data.message,
                        'success'
                    )
                    $('#questionsTableId').DataTable().ajax.reload();
                })
                .catch((error) => {
                    Swal.fire(
                        'Error!',
                        'Something went wrong',
                        'error'
                    )
                });

        } else {
            Swal.fire(
                'Cancelled',
                'Your data is safe',
                'error'
            )
        }
    });
}


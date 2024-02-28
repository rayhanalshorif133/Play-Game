$(document).ready(function () {

    url = '/user';
    table = $('#userTableId').DataTable({
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
                return row.name;
            },
            targets: 0,
        },
        {
            render: function (data, type, row) {
                return row.email;
            },
            targets: 0,
        },
        {
            render: function (data, type, row) {
                var role = '';
                row.role == 'super-admin' ? role = `<span class="badge bg-label-info">Super Admin</span>` :
                    role = `<span class="badge bg-label-primary">Admin</span>`;
                return role;
            },
            targets: 0,
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
                return `<div>
                            <span class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editUserinfo" onClick="editUserInfoBtn(${row.id})">
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



    $(".createNewUser").click(function () {
        $('#user_name').val('');
        $('#password').val('');
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
                success: function (response) {
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
    $('#update_user_id').val(id);
    axios.get(`/user/fetch/${id}`)
        .then(response => {
            const data = response.data.data;
            $('#update_user_name').val(data.name);
            $('#update_user_email').val(data.email);
            $('#update_user_role').val(data.role);
            $('#update_user_status').val(data.status);
            $('#update_password').val('');
        })
        .catch(error => {
            console.log(error);
        });
};

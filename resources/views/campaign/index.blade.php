@extends('layouts.app')

@section('content')
    <div class="px-3 container-p-y">
        <div class="row p-1rem">
            <div class="card pb-2">
                <div class="d-flex justify-content-between px-2">
                    <h5 class="card-header">Campaigns Table</h5>
                    <a href="{{ route('campaigns.create') }}" class="btn btn-primary btn-sm d-block d-flex my-3">Add New
                        Capaign</a>
                </div>
                <div class="table-responsive text-nowrap scrollbar-hidden overflow-x-scroll">
                    <table class="table" id="campaignsTableId">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Type</th>
                                <th>Created By</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- user edit modal:start --}}
    {{-- @include('user.create')
    @include('user.edit') --}}
    {{-- user edit modal:end --}}
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
           var url = '/campaigns';
            var table = $('#campaignsTableId').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: url,
                columns: [{
                        render: function(data, type, row) {
                            return row.DT_RowIndex;
                        },
                        targets: 0,
                    },
                    {
                        render: function(data, type, row) {
                            return row.title;
                        },
                        targets: 1,
                    },


                    {
                        render: function(data, type, row) {
                            type = '<span class="badge bg-label-primary">Quiz</span>';

                            if (row.type == 'game') {
                                type = '<span class="badge bg-label-info">Game</span>';
                            }

                            return type;
                        },
                        targets: 1,
                    },

                    {
                        render: function(data, type, row) {
                            const name = row.created_by.name;
                            return name;
                        },
                        targets: 1,
                    },
                    {
                        render: function(data, type, row) {
                            var status = "";
                            row.status == 'active' ? status = `<span class="badge bg-success">Active</span>` :
                                status = `<span class="badge bg-danger">Inactive</span>`;
                            return status;
                        },
                        targets: 0,
                    },
                    {
                        render: function(data, type, row) {
                            return `<a href="/campaigns/${row.id}" class="btn btn-primary btn-sm"><i class='bx bx-show'></i></a>
                                    <a href="/campaigns/${row.id}/edit" class="btn btn-warning btn-sm"><i class='bx bx-edit-alt'></i></a>
                                    <button class="btn btn-danger btn-sm" onclick="deleteCampaign(${row.id})"><i class='bx bxs-trash-alt'></i></button>`;
                        },
                        targets: 0,
                    },
                ],
            });
        });
    </script>
@endpush

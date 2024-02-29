@extends('layouts.app')

@section('content')
    <div class="px-3 container-p-y">
        <div class="row p-1rem">
            <div class="card pb-2">
                <div class="d-flex justify-content-between px-2">
                    <h5 class="card-header">Campaign Durations</h5>
                    <div class="d-flex space-x-5 my-2_5">
                        <a href="{{ route('campaigns.index') }}" class="btn btn-danger btn-sm d-block d-flex">
                            <i class='bx bx-arrow-back me-1'></i> Back</a>
                        <button class="btn btn-primary btn-sm d-flex items-center createCampaignDuration"
                            data-bs-toggle="modal" data-bs-target="#createNewcampaignDuration">
                            <i class='bx bx-plus'></i> <span>Add New</span>
                        </button>
                    </div>
                    <input type="hidden" id="GET_campaign_id" value="{{ $campaign->id }}">
                    <input type="hidden" id="GET_selected_campaign" value="{{ $campaign->title }}">
                </div>
                <div class="table-responsive text-nowrap scrollbar-hidden overflow-x-scroll">
                    <table class="table" id="campaignDurationsTableID">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('campaign.campaign-durations.create')
@endsection


{{-- scripts --}}
@push('scripts')
    <script>
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
                            return `<span onClick="showCampaignDetails(${row.id})" data-bs-toggle="modal" data-bs-target="#showDetailsCampaign" class="btn btn-primary btn-sm"><i class='bx bx-show'></i></span>
                             <a href="/campaigns/${row.id}/edit" class="btn btn-warning btn-sm"><i class='bx bx-edit-alt'></i></a>
                    <button class="btn btn-danger btn-sm" onclick="deleteCampaign(${row.id})"><i class='bx bxs-trash-alt'></i></button>`;
                        },
                        targets: 0,
                        width: "auto",
                    },
                ],
            });

            createCampaignDuration();
        });


        const createCampaignDuration = () => {
            const campaign_id = $("#GET_campaign_id").val();
            const selected_campaign = $("#GET_selected_campaign").val();
            $("#campaign_id").val(campaign_id);
            $("#selected_campaign").html(selected_campaign);
        };
    </script>
@endpush

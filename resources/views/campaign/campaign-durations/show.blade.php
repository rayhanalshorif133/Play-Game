@extends('layouts.app')

@section('content')
    <div class="px-3 container-p-y">
        <div class="row p-1rem">
            <div class="card pb-2">
                <div class="d-flex justify-content-between px-2">
                    <h5 class="card-header">Campaign Durations</h5>
                    <div class="d-flex space-x-5 my-2_5">
                        <a href="{{ route('admin.campaigns.index') }}" class="btn btn-danger btn-sm d-block d-flex">
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
    @include('campaign.campaign-durations.edit')
@endsection

@push('scripts')
    <script src="{{ asset('js/custom/campaigns/durations.js') }}"></script>
@endpush


@extends('layouts.app')

@section('content')
    <div class="px-3 container-p-y">


        <div class="row p-1rem">
            <div class="card pb-2">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="daily-tab" data-bs-toggle="tab" data-bs-target="#daily"
                            type="button" role="tab" aria-controls="daily" aria-selected="true">Daily</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="weekly-tab" data-bs-toggle="tab" data-bs-target="#weekly"
                            type="button" role="tab" aria-controls="weekly" aria-selected="false">Weekly</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="daily" role="tabpanel" aria-labelledby="daily-tab">
                        <div class="row">
                            <div class="col-lg-4 col-12 col-sm-6 my-2">
                                <h5 class="card-header">
                                    Daily Campaign Report
                                </h5>
                            </div>
                            <div class="col-lg-4 col-12 col-sm-6 my-2">
                                <div class="d-flex filterByCampaignContainer">
                                    <label for="campaignSelect">Select Date</label>
                                    <input type="date" id="selectDate" class="form-control" />
                                </div>
                            </div>
                            <div class="col-lg-4 col-12 col-sm-6 my-2">
                                <div class="d-flex filterByCampaignContainer">
                                    <label for="campaignSelect">Select Campaign</label>
                                    <select class="form-select" id="campaignSelect">
                                        <option value="0" selected disabled>Choice a option</option>
                                        @foreach ($campaigns as $item)
                                            <option @if ($active_camp->id == $item->id) selected @endif
                                                value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    <button type="button" class="btn btn-sm btn-primary btnSearch"
                                        data-type='weekly'>Search</button>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive text-nowrap scrollbar-hidden overflow-x-scroll">
                            <table class="table" id="leaderboardScoreLogs">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Campaign name</th>
                                        <th>msisdn</th>
                                        <th>Date</th>
                                        <th>Total Score</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="weekly" role="tabpanel" aria-labelledby="weekly-tab">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-header">
                                Weekly Campaign Report
                            </h5>
                            <div class="d-flex filterByCampaignContainer">
                                <label for="campaignSelect">Select Campaign</label>
                                <select class="form-select" id="campaignSelectWeekly">
                                    <option value="0" selected disabled>Choice a option</option>
                                    @foreach ($campaigns as $item)
                                        <option @if ($active_camp->id == $item->id) selected @endif
                                            value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                <button type="button" class="btn btn-sm btn-primary btnSearch"
                                    data-type='weekly'>Search</button>
                            </div>
                        </div>
                        <div class="table-responsive text-nowrap scrollbar-hidden overflow-x-scroll">
                            <table class="table" id="leaderboardScoreLogsWeekly">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Campaign name</th>
                                        <th>msisdn</th>
                                        <th>Date</th>
                                        <th>Total Score</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection


{{-- scripts --}}
@push('scripts')
    <script>
        $(document).ready(function() {
            var url = '/admin/campaign-score-logs?type=daily';
            var type = 'daily';
            handleDataTable(url);
            $("#weekly-tab").click(() => {
                type = 'weekly';
                url = '/admin/campaign-score-logs?type=weekly';
                handleDataTableWeekly(url);
            });
            $(".btnSearch").click(() => {
                var selected_campaign = $('#campaignSelect').val();
                var selected_date = $('#selectDate').val();
                url = '/admin/campaign-score-logs?type=' + type + '&campaign_id=' + selected_campaign +
                    '&date=' +
                    selected_date;
                if (type == 'daily') {
                    handleDataTable(url);
                } else {
                    selected_campaign = $('#campaignSelectWeekly').val();
                    url = '/admin/campaign-score-logs?type=' + type + '&campaign_id=' + selected_campaign;
                    handleDataTableWeekly(url);
                }
            });
        });

        const handleDataTable = (url) => {
            if ($.fn.DataTable.isDataTable('#leaderboardScoreLogs')) {
                $('#leaderboardScoreLogs').DataTable().destroy();
            }
            $('#leaderboardScoreLogs').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ordering: false,
                order: [
                    [2, 'desc']
                ],
                pageLength: 25,
                ajax: url,
                columns: [{
                        render: function(data, type, row) {
                            return row.DT_RowIndex;
                        },
                        targets: 0,
                        className: 'fit-content' // Add a custom class
                    },
                    {
                        render: function(data, type, row) {
                            return row.camp_name;
                        },
                        targets: 0,
                        className: 'fit-content' // Add a custom class
                    },
                    {
                        render: function(data, type, row) {
                            return row.msisdn;
                        },
                        targets: 0,
                        className: 'fit-content' // Add a custom class
                    },
                    {
                        render: function(data, type, row) {
                            const date = moment(row.date).format('ll')
                            return date;
                        },
                        targets: 0,
                        className: 'fit-content' // Add a custom class
                    },
                    {
                        render: function(data, type, row) {
                            return row.total_score;
                        },
                        targets: 0,
                        className: 'fit-content' // Add a custom class
                    },
                ],
            });
        };


        const handleDataTableWeekly = (url) => {
            if ($.fn.DataTable.isDataTable('#leaderboardScoreLogsWeekly')) {
                $('#leaderboardScoreLogsWeekly').DataTable().destroy();
            }
            $('#leaderboardScoreLogsWeekly').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ordering: false,
                order: [
                    [2, 'desc']
                ],
                pageLength: 25,
                ajax: url,
                columns: [{
                        render: function(data, type, row) {
                            return row.DT_RowIndex;
                        },
                        targets: 0,
                        className: 'fit-content' // Add a custom class
                    },
                    {
                        render: function(data, type, row) {
                            return row.camp_name;
                        },
                        targets: 0,
                        className: 'fit-content' // Add a custom class
                    },
                    {
                        render: function(data, type, row) {
                            return row.msisdn;
                        },
                        targets: 0,
                        className: 'fit-content' // Add a custom class
                    },
                    {
                        render: function(data, type, row) {
                            const date = moment(row.date).format('ll')
                            return date;
                        },
                        targets: 0,
                        className: 'fit-content' // Add a custom class
                    },
                    {
                        render: function(data, type, row) {
                            return row.total_score;
                        },
                        targets: 0,
                        className: 'fit-content' // Add a custom class
                    },
                ],
            });
        };
    </script>
@endpush

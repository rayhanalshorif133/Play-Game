@extends('layouts.app')

@section('content')
    <div class="px-3 container-p-y">
        <div class="row p-1rem">
            <div class="card pb-2">
                <div class="d-flex justify-content-between">
                    <h5 class="card-header">
                        Campaign Score Logs
                    </h5>
                    <div class="d-flex filterByCampaignContainer">
                        <label for="campaignSelect">Select Campaign</label>
                        <select class="form-select" id="campaignSelect">
                            <option value="0" selected disabled>Choice a option</option>
                            @foreach ($campaigns as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        <button type="button" class="btn btn-sm btn-primary" id="btnSearch">Search</button>
                    </div>
                </div>
                <div class="table-responsive text-nowrap scrollbar-hidden overflow-x-scroll">
                    <table class="table" id="leaderboardScoreLogs">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Campaign name</th>
                                <th>msisdn</th>
                                <th>Total Score</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection


{{-- scripts --}}
@push('scripts')
    <script>
        $(document).ready(function() {
            var url = '/admin/campaign-score-logs';
            handleDataTable(url);
            $("#btnSearch").click(() => {
                const selected_campaign = $('#campaignSelect').val();
                url = '/admin/campaign-score-logs?campaign_id=' + selected_campaign;
                handleDataTable(url);
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
                ordering: true,
                order: [
                    [2, 'desc']
                ],
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

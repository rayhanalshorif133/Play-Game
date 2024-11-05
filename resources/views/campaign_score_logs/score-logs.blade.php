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
                        <label for="dateSelect" class="me-2">Select Date</label>
                        <input type="date" id="dateSelect" class="form-control"/>
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
                                <th>Score</th>
                                <th>Date</th>
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
            var url = '/admin/score-logs';
            handleDataTable(url);
            $("#btnSearch").click(() => {
                const date = $('#dateSelect').val();
                url = '/admin/score-logs?date=' + date;
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
                            return row.name;
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
                            return row.score;
                        },
                        targets: 0,
                        className: 'fit-content' // Add a custom class
                    },
                    {
                        render: function(data, type, row) {
                            return row.date_time;
                        },
                        targets: 0,
                        className: 'fit-content' // Add a custom class
                    },

                ],
            });
        };

    </script>
@endpush

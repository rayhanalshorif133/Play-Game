@extends('layouts.app')

@section('content')
    <div class="px-3 container-p-y">
        <div class="row p-1rem">
            <div class="card pb-2">
                <div class="d-flex justify-content-between">
                    <h5 class="card-header">
                        Subscribers List
                    </h5>
                    <div class="d-flex filterByCampaignContainer">
                        <label for="dateSelect" class="me-2">Select Date</label>
                        <input type="date" id="dateSelect" class="form-control"/>
                        <button type="button" class="btn btn-sm btn-primary" id="btnSearch">Search</button>
                    </div>
                </div>
                <div class="table-responsive text-nowrap scrollbar-custom overflow-x-scroll">
                    <table class="table" id="subscriberTableId">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Msisdn</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- user edit modal:start --}}
    {{-- user edit modal:end --}}
@endsection


{{-- scripts --}}
@push('scripts')
    <script>
        $(document).ready(function() {
            var url = '/admin/subscribers';
            handleDataTable(url);
            $("#btnSearch").click(() => {
                const date = $('#dateSelect').val();
                url = '/admin/subscribers?date=' + date;
                handleDataTable(url);
            });
        });

        const handleDataTable = (url) => {
            if ($.fn.DataTable.isDataTable('#subscriberTableId')) {
                $('#subscriberTableId').DataTable().destroy();
            }
            $('#subscriberTableId').DataTable({
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
                            return row.msisdn;
                        },
                        targets: 0,
                        className: 'fit-content' // Add a custom class
                    },
                    {
                        render: function(data, type, row) {
                            return 1;
                        },
                        targets: 0,
                        className: 'fit-content' // Add a custom class
                    },

                ],
            });
        };
    </script>
@endpush

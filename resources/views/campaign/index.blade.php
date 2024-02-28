@extends('layouts.app')

@section('content')
    <div class="px-3 container-p-y">
        <div class="row p-1rem">
            <div class="card pb-2">
                <div class="d-flex justify-content-between px-2">
                    <h5 class="card-header">Campaigns List</h5>
                    <a href="{{ route('campaigns.create') }}" class="btn btn-primary btn-sm d-block d-flex my-3">Add New
                        Capaign</a>
                </div>
                <div class="table-responsive text-nowrap scrollbar-custom overflow-x-scroll">
                    <table class="table overflow-x-scroll" id="campaignsTableId">
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

    @include('campaign.show')
@endsection

@push('scripts')
    <script src="{{asset('js/custom/campaigns.js')}}"></script>
@endpush

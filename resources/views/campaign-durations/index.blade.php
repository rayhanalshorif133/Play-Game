@extends('layouts.app')

@section('content')
    <div class="px-3 container-p-y">
        <div class="row p-1rem">
            <div class="card pb-2">
                <div class="d-flex justify-content-between px-2">
                    <h5 class="card-header">Campaign Durations List</h5>
                    <button class="btn btn-primary btn-sm d-block d-flex my-2"
                    data-bs-toggle="modal" data-bs-target="#createNewcampaignDuration">
                    Add Campaign Duration
                </button>
                </div>
                <div class="table-responsive text-nowrap scrollbar-custom overflow-x-scroll">
                    <table class="table" id="userTableId">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- user edit modal:start --}}
    @include('campaign-durations.create')
    @include('campaign-durations.edit')
    {{-- user edit modal:end --}}
@endsection


{{-- scripts --}}
@push('scripts')
@endpush

@extends('layouts.app')

@section('content')
    <div class="px-3 container-p-y">
        <div class="row p-1rem">
            <div class="card pb-2">
                <div class="d-flex justify-content-between px-2">
                    <h5 class="card-header">Campaigns Details</h5>
                </div>
                @if (session('success'))
                    <div class="alert alert-primary">
                        {{ session('success') }}
                    </div>
                @endif
                <form action="{{ route('admin.campaigns') }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="row px-5">
                        @php
                            use Carbon\Carbon;
                            $startDate = Carbon::parse($campaignDuration->start_date_time)->toDateString(); // Outputs: 2024-10-29
                            $endDate = Carbon::parse($campaignDuration->end_date_time)->toDateString(); // Outputs: 2024-11-02
                            $startTime = Carbon::parse($campaignDuration->start_date_time)->toTimeString(); // Outputs: 2024-10-29
                            $startTime = \Carbon\Carbon::parse($startTime)->format('H:i');
                            $endTime = Carbon::parse($campaignDuration->end_date_time)->toTimeString(); // Outputs: 2024-11-02
                            $endTime = \Carbon\Carbon::parse($endTime)->format('H:i');
                        @endphp
                        <div class="col-12 col-md-6 mb-1">
                            Start Date & Time:
                            <input type="date" class="form-control my-2" name="start_date" value="{{ $startDate }}" />
                            <input type="time" class="form-control my-2" name="start_time" value="{{ $startTime }}" />
                        </div>
                        <div class="col-12 col-md-6 mb-1">
                            End Date & Time:
                            <input type="date" class="form-control my-2" name="end_date" value="{{ $endDate }}" />
                            <input type="time" class="form-control my-2" name="end_time" value="{{ $endTime }}" />
                        </div>
                    </div>
                    <div class="px-5">
                        <button type="submit" class="btn btn-sm btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/custom/campaigns/index.js') }}"></script>
@endpush

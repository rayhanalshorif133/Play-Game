@extends('layouts.app_public')

@section('content')
    <div class="row">
        @foreach ($campaigns as $item)
            <div class="col-md-4">
                <div class="card h-auto">
                    <div class="card-body ">
                        <img src="https://picsum.photos/500/300?random=1" alt="client logo" class="client-logo img-fluid mb-2">
                        <p>
                            <strong>Campaign Title:</strong>
                            {{ $item->title }}
                        </p>
                        @foreach ($item->campaignDuration as $campaign_duration)
                        <div>
                            <strong>Name:</strong> {{ $campaign_duration->name }}
                            <div class="row">
                                <div class="col-md-6"><strong>Start Date:</strong> {{ $campaign_duration->start_date }}</div>
                                <div class="col-md-6"><strong>End Date:</strong> {{ $campaign_duration->end_date }}</div>
                            </div>
                            <button class="btn btn-primary btn-sm">Join</button>
                        </div>
                        <hr>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection


{{-- scripts --}}
@push('scripts')
@endpush

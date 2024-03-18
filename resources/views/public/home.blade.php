@extends('layouts.app_public')

@section('content')
    <div class="row">
        @foreach ($campaigns as $item)
            <div class="col-md-4">
                {{ $item }}
                <div class="card h-auto">
                    <div class="card-body ">
                        <img src="https://picsum.photos/500/300?random=1" alt="client logo" class="client-logo img-fluid mb-2">
                        <p>
                            <strong>Campaign Title:</strong>
                            {{ $item->title }}
                        </p>
                        <p>
                            <strong>Start Date:</strong>
                            {{ $item->start_date }}
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection


{{-- scripts --}}
@push('scripts')
@endpush

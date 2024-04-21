@extends('layouts.app_public', ['title' => 'Home'])

@section('styles')
@endsection

@section('content')
    <div class="mx-auto flex justify-content-center">
        <div class="card">
            <div>
                <p class="text-center mx-auto">
                    Campaign Teams & Conditions
                </p>
                <a href="#" class="text-center mx-auto text-decoration-none text-dark w-full">
                    <span class="fw-bold d-block flex text-center">
                        Campaign Name
                    </span>
                </a>
                <div class="card-body">
                    <p class="card-text">
                        <span class="fw-bold">Description:</span>
                        <span class="text-muted">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam,
                            voluptates.</span>
                    </p>
                    <p class="card-text">
                        <span class="fw-bold">Start Date:</span>
                        <span class="text-muted">2021-09-01</span>
                    </p>
                    <p class="card-text">
                        <span class="fw-bold">End Date:</span>
                        <span class="text-muted
                        ">2021-09-30</span>
                    </p>
                    <p class="card-text">
                        <span class="fw-bold">Status:</span>
                        <span class="text-muted
                        ">Active</span>
                    </p>
                    <p class="card-text">
                        <span class="fw-bold">Created At:</span>
                        <span class="text-muted"></span>2021-09-01 12:00:00</span>
                    </p>
                    <p class="card-text">
                        <span class="fw-bold">Updated At:</span>
                        <span class="text-muted"></span>2021-09-01 12:00:00</span>
                    </p>
                    <div class="text-center pb-5">
                        <a href="#" class="btn btn-primary">Play Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


{{-- scripts --}}
@push('scripts')
@endpush

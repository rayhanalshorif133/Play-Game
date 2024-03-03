@extends('layouts.app')

@section('content')
    <div class="px-3 container-p-y">
        <div class="row p-1rem">
            <div class="card pb-2">
                <div class="d-flex justify-content-between px-2">
                    <h5 class="card-header">
                        Questions List
                    </h5>
                    <a href="{{route('questions.create')}}" class="btn btn-primary btn-sm d-block d-flex my-2">Add New Question</a>
                </div>
                <div class="table-responsive text-nowrap scrollbar-hidden overflow-x-scroll">
                    <table class="table" id="questionsTableId">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Currect Option</th>
                                <th>CreatedBy</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- user edit modal:start --}}
    {{-- @include('user.create')
    @include('user.edit') --}}
    {{-- user edit modal:end --}}
@endsection


{{-- scripts --}}
@push('scripts')
    <script src="{{ asset('js/custom/question/index.js') }}"></script>
@endpush

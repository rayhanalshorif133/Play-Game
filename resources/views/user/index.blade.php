@extends('layouts.app')

@section('content')
    <div class="px-3 container-p-y">
        <div class="row p-1rem">
            <div class="card pb-2">
                <div class="d-flex justify-content-between px-2">
                    <h5 class="card-header">User List</h5>
                    <button class="btn btn-primary btn-sm d-block d-flex my-2 createNewUser" data-bs-toggle="modal"
                        data-bs-target="#createNewUserinfo">Add User</button>
                </div>
                <div class="table-responsive text-nowrap scrollbar-custom overflow-x-scroll">
                    <table class="table" id="userTableId">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>User Name</th>
                                <th>Msisdn</th>
                                <th>Role</th>
                                <th>Status</th>
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
    <script src="{{ asset('js/custom/user.js') }}"></script>
@endpush

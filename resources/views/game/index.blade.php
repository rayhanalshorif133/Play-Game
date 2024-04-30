@extends('layouts.app')

@section('content')
    <div class="px-3 container-p-y">
        <div class="row p-1rem">
            <div class="card pb-2">
                <div class="d-flex justify-content-between px-2">
                    <h5 class="card-header">Games List</h5>
                    <a href="#" class="btn btn-primary btn-sm d-block d-flex my-3" data-bs-toggle="modal" data-bs-target="#createNewGame">
                        Add New Game
                    </a>
                </div>
                <div class="table-responsive text-nowrap scrollbar-custom overflow-x-scroll">
                    <table class="table overflow-x-scroll" id="gameTableId">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Keyword</th>
                                <th>Url</th>
                                <th>Status</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('game.create_and_update')
@endsection

@push('scripts')
    <script src="{{ asset('js/custom/game.js') }}"></script>
@endpush

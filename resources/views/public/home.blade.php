@extends('layouts.app_public', ['title' => 'Home'])

@section('content')
    <div class="row">
        <div class="col-12 col-sm-6 col-md-4 mb-3">
            <div class="card">
                <div>
                    <a href="#" class="text-center mx-auto text-decoration-none text-dark w-full">
                        <span class="fw-bold d-block flex text-center">
                            Campaign/Tournament Name
                        </span>
                    </a>
                </div>
                <img src="https://picsum.photos/200/300" class="card-img-top" alt="image">
                <div class="card-body">
                    <div class="flex justify-between">
                        <div>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-gray"></i>
                            <i class="fa fa-star text-gray"></i>
                            <i class="fa fa-star text-gray"></i>
                            <div>
                                <span class="fw-bold">
                                    <i class="fa fa-eye text-gray"></i>
                                    <span>2000</span>
                                </span>
                            </div>
                        </div>
                        <a href="#">
                            <i class="fa fa-heart text-danger"></i>
                        </a>
                    </div>
                    <div class="flex justify-content-between">
                        <a href="#" class="btn flex flex-col text-center">
                            <i class="fa-solid fa-ranking-star fa-fw text-center mx-auto" style="font-size: 25px"></i>
                            <span style="font-size: 12px">Leaderboard</span>
                        </a>
                        <a href="#" class="btn btn-play-now">
                            <i class="fa fa-play text-white"></i>
                        </a>
                        </a><a href="#" class="btn flex flex-col text-center">
                            <i class="fa-solid fa-award text-center mx-auto" style="font-size: 25px"></i>
                            <span style="font-size: 12px">Winner List</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


{{-- scripts --}}
@push('scripts')
@endpush

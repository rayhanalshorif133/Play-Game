@extends('layouts.app_public', ['title' => 'Home'])

@section('styles')
    <style>
        .leaderboard,
        .winner_list {
            background-color: #ececec;
            color: #000;
        }

        .leaderboard:hover,
        .winner_list:hover {
            background-color: #176B87;
            color: #dbf5ff;
        }



    </style>
@endsection

@section('content')
    <div class="row">
        {{-- 1 to 10 print using foreach --}}
        @foreach (range(1, 2) as $number)
            <div class="col-12 col-sm-6 col-md-4 mb-3">
                <div class="card">
                    <div>
                        <a href="#" class="text-center mx-auto text-decoration-none text-dark w-full">
                            <span class="fw-bold d-block flex text-center">
                                Campaign Name
                            </span>
                        </a>
                    </div>
                    <img src="https://picsum.photos/200/300?random={{ $number }}" class="card-img-top" alt="image">
                    <div class="card-body">
                        <div class="flex justify-between">
                            <div>
                                <div>
                                    <span class="fw-bold">
                                        <i class="fa fa-eye text-gray"></i>
                                        <span>2000</span>
                                    </span>
                                </div>
                            </div>
                            <a href="#" class="btn">
                                Price <i class="fa fa-money"></i> 1000
                            </a>
                        </div>
                        <div class="flex justify-content-between py-2">
                            <a href="#" class="btn flex flex-col text-center leaderboard">
                                <i class="fa-solid fa-ranking-star fa-fw text-center mx-auto" style="font-size: 25px"></i>
                                <span style="font-size: 12px">Leaderboard</span>
                            </a>
                            <a href="#" class="btn btn-play-now">
                                <i class="fa fa-play text-white"></i>
                            </a>
                            <a href="#" class="btn flex flex-col text-center winner_list">
                                <i class="fa-solid fa-award text-center mx-auto" style="font-size: 25px"></i>
                                <span style="font-size: 12px">Winner List</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach



    </div>
@endsection


{{-- scripts --}}
@push('scripts')
@endpush

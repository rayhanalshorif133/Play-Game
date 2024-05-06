@extends('layouts.app_public', ['title' => 'Home'])

@section('styles')
    <style>
        .game_image {
            width: 100%!important;
            border-radius: 3%!important;
        }
    </style>
@endsection

@section('content')
    <main role="main">
        <!--/ Section one Star /-->
        <section id="section_one">
            <div class="container  mt-5">
                <div class="wrap-one  d-flex justify-content-between">
                    <div class="title-box">
                        <h3 class="title-a">Current Campaign</h3>
                    </div>
                </div>
                <div class="row">
                    @foreach ($currentCampaignDurations as $campaignDuration)
                        <div class="col-md-4 col-sm-12">
                            <div class="card my-4 box-shadow">
                                <img class="card-img img-fluid game_image" src="{{ asset($campaignDuration->game->banner) }}"
                                    alt="Card image cap">
                                <div class="card-body" style="padding-left: 10px;padding-bottom: 10px;">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group" style="display: block !important;">
                                            <h4 class="font-bold" style="font-size: 1.2rem;font-weight: bold;">
                                                {{ $campaignDuration->campaign->title }} <br/>
                                                ({{ $campaignDuration->name }})
                                            </h4>
                                            <p class="card-text" style="color: red;">
                                                Time Remains:
                                                {{ $campaignDuration->duration }}</p>
                                        </div>
                                        <a type="btn" class="btn  btn-outline-secondary text-white common-btn"
                                            style="width: 150px"
                                            href="{{ route('campaign.campaign-details', $campaignDuration->id) }}">Play
                                            now</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </section>
        <!--/ Section one End /-->
        <!--/ Section two Star /-->
        <section id="section_two" style="margin-bottom: 30%;">
            <div class="container">
                <div class="wrap-one  d-flex justify-content-between">
                    <div class="title-box">
                        <h3 class="title-a my-2">Upcoming Campaign</h3>
                    </div>
                </div>
                <div class="row">
                    @foreach ($upcomingCampaignDurations as $upcomingCampaign)
                        <div class="col-md-4 col-sm-12 mt-2">
                            <div class="campain-body">
                                <div class="row row-cols-1 row-cols-sm-2">
                                    <div class="col-6">
                                        <figure style="margin: 0px;">
                                            <img class="card-img img-fluid"
                                                src="{{ asset($upcomingCampaign->game->banner) }}" alt="Card image"
                                                style="height: 200px" />
                                        </figure>
                                    </div>
                                    <div class="col-6" style="margin-top: 6%;">
                                        <div class="card-body-right">
                                            <h4 class="card-title font-bold" style="font-weight: bold; font-size: 1.3rem;">
                                                {{ $upcomingCampaign->campaign->title }} <br/>
                                                ({{ $upcomingCampaign->name }})
                                            </h4>
                                            <p class="card-text " style="color: green;">Start after:
                                                {{ $upcomingCampaign->duration }}</p>
                                            <a href="{{ route('campaign.campaign-details', $upcomingCampaign->id) }}"
                                                class="btn btn-primary  common-btn">Explore now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </section>
        <!--/ Section one End /-->

    </main>
@endsection


{{-- scripts --}}
@push('scripts')
@endpush

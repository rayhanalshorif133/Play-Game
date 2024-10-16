@extends('layouts.app_public', ['title' => 'Home'])

@section('styles')
@endsection

@section('content')
    <main role="main">
        <!--/ Section one Star /-->
        <section id="section_one">
            <div class="container  mt-5">
                <div class="button-container">
                    <button class="gradient-button">
                        <i class="fa-solid fa-gamepad" style="font-size:20px"></i>
                        @php
                            $random = rand(11111,99999);
                        @endphp
                        {{ $random }}
                    </button>
                </div>
                <div style="width: 100%">

                    @if (count($currentCampaignDurations) > 0)
                        <div class="card my-4 box-shadow mx-auto" style="width: 24rem">
                            <img class="card-img img-fluid game_image"
                                src="{{ asset($currentCampaignDurations[0]->game->banner) }}" alt="Card image cap">
                        </div>
                    @endif
                    <div class="mx-auto" style="width: fit-content">
                        <a href="{{ route('campaign.campaign-details', $currentCampaignDurations[0]->id) }}"
                            class="play-now-button">Play Now</a>
                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection


{{-- scripts --}}
@push('scripts')
@endpush

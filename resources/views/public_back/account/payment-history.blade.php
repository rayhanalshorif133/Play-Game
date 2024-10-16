@extends('layouts.app_public', ['title' => 'Tournament'])

@section('styles')
@endsection

@section('content')
    <div class="mt-5">
        <div class="wrapper container">
            <section id="top-leaderbord">
                <div class="container-fluid">
                    <div class="row justify-content-start mb-3 leaderboard-top-panel">
                        <div class="col-1 arrow-icon" style="color: #fff;">
                            <a href="{{ URL::previous() }}">
                                <i class="fas fa-arrow-left "
                                    style="color: #fff; font-size: calc(1.5em + 1vmin); padding-top: 15px;"></i>
                            </a>
                        </div>
                        <div class="col-11 text-center d-block text-center-panel">
                            <a href="{{ route('home') }}"
                                class="justify-content-center text-black d-flex mt-1 mb-3 font-weight-bold"
                                style="font-size: calc(1.8em + 1vmin); color: #fff;">
                                Payment History
                            </a>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="tap-header">
                                <ul class="nav nav-pills mb-3 justify-content-center " id="pills-tab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link  text-center active" id="pills-daily-tab" data-toggle="pill"
                                            href="#pills-daily" role="tab" aria-controls="pills-daily"
                                            aria-selected="true">Daily</a>
                                    </li>
                                    <li class="nav-item " role="presentation">
                                        <a class="nav-link  text-center" id="pills-weekly-tab" data-toggle="pill"
                                            href="#pills-weekly" role="tab" aria-controls="pills-weekly"
                                            aria-selected="false">Weekly</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content justify-content-center" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-daily" role="tabpanel"
                                    aria-labelledby="pills-daily-tab">
                                    <div id="score-panel">
    
                                        <div class="tab-content" style="margin-bottom: 5%;">
                                            <div class="tab-pane fade show active" id="one" role="tabpanel"
                                                aria-labelledby="one-tab">
                                                <div class="score-bord-panel">
                                                    <div class="table-wrapper-scroll-y my-custom-scrollbar">
    
                                                        <!-- ================================== -->
                                                        <div class="title-panel mb-3">
                                                            <div class="row row-cols-1 row-cols-sm-3 border-b-slate-200">
                                                                <div class="col-2">
                                                                    <p class="number font-weight-bold"
                                                                        style="padding-left: 2%;">
                                                                        #sl
                                                                    </p>
                                                                </div>
                                                                <div class="col-4">
                                                                    <p class="number font-weight-bold"
                                                                        style="padding-left: 2%;">
                                                                        Campaign / Tournament Name
                                                                    </p>
                                                                </div>
                                                                <div class="col-3 d-block text-center clock">
                                                                    <p class="second text-black font-weight-bold">
                                                                        Bkash Number
                                                                    </p>
                                                                </div>
    
                                                                <div class="col-3 d-block text-center score"
                                                                    style="padding: 0px;">
                                                                    <p class="d-block text-black font-weight-bold">Amount</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- ================================== -->
                                                        <div class="score-body scroll-container">
                                                            @foreach ($bkashPayments as $key => $item)
                                                            <div class="score-part mb-3 scroll-page">
                                                                <div class="row row-cols-1 row-cols-sm-3">
                                                                    <div class="col-2">
                                                                        <p class="number">
                                                                            {{$key+1}}
                                                                        </p>
                                                                    </div>
                                                                    <div class="col-4  d-block text-center">
                                                                        <p class="second ">
                                                                        @if($item->campaign)
                                                                            {{$item->campaign->title}} ( {{$item->campaignDuration->name}})
                                                                        @else 
                                                                        {{$item->campaignDuration->name}}
                                                                        @endif
                                                                        </p>
                                                                    </div>
                                                                    <div class="col-3  d-block text-center">
                                                                        <p class="second ">{{$item->bkash_msisdn}}</p>
                                                                    </div>
    
                                                                    <div class="col-3  d-block text-center ">
                                                                        <p class="second ">{{$item->amount}} tk</p>
                                                                    </div>
    
                                                                </div>
                                                            </div>
                                                            @endforeach
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-weekly" role="tabpanel"
                                    aria-labelledby="pills-weekly-tab">
                                    <div id="score-panel">
                                        <div class="tab-content" style="margin-bottom: 5%;">
                                            <div class="tab-pane fade show active" id="one" role="tabpanel"
                                                aria-labelledby="one-tab">
                                                <div class="score-bord-panel">
                                                    <div class="table-wrapper-scroll-y my-custom-scrollbar">
    
    
                                                        <div class="title-panel mb-3">
                                                            <div class="row row-cols-1 row-cols-sm-3 border-b-slate-200">
                                                                <div class="col-2">
                                                                    <p class="number font-weight-bold"
                                                                        style="padding-left: 2%;">
                                                                        #sl
                                                                    </p>
                                                                </div>
                                                                <div class="col-4">
                                                                    <p class="number font-weight-bold"
                                                                        style="padding-left: 2%;">
                                                                        Campaign / Tournament Name
                                                                    </p>
                                                                </div>
                                                                <div class="col-3 d-block text-center clock">
                                                                    <p class="second text-black font-weight-bold">Phone</p>
                                                                </div>
    
                                                                <div class="col-3 d-block text-center score"
                                                                    style="padding: 0px;">
                                                                    <p class="d-block text-black font-weight-bold">Amount</p>
                                                                </div>
                                                            </div>
                                                        </div>
    
                                                        <div class="score-body scroll-container">
                                                            @foreach ($bkashPayments as $key => $item)
                                                            <div class="score-part mb-3 scroll-page">
                                                                <div class="row row-cols-1 row-cols-sm-3">
                                                                    <div class="col-2">
                                                                        <p class="number">
                                                                            {{$key+1}}
                                                                        </p>
                                                                    </div>
                                                                    <div class="col-4  d-block text-center">
                                                                        <p class="second ">
                                                                        @if($item->campaign)
                                                                            {{$item->campaign->title}} ( {{$item->campaignDuration->name}})
                                                                        @else 
                                                                        {{$item->campaignDuration->name}}
                                                                        @endif
                                                                        </p>
                                                                    </div>
                                                                    <div class="col-3  d-block text-center">
                                                                        <p class="second ">{{$item->bkash_msisdn}}</p>
                                                                    </div>
    
                                                                    <div class="col-3  d-block text-center ">
                                                                        <p class="second ">{{$item->amount}} tk</p>
                                                                    </div>
    
                                                                </div>
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
    
                                        </div>
    
    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
{{-- scripts --}}
@push('scripts')
@endpush

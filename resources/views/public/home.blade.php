@extends('layouts.app_public', ['title' => 'Home'])

@section('styles')
@endsection

@section('content')
    <main role="main">
        <!--/ Section one Star /-->
        <section id="section_one">
            <div class="container">
                <div class="wrap-one  d-flex justify-content-between">
                    <div class="title-box">
                        <h2 class="title-a">Current Campaign</h2>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-md-4 col-sm-12">
                        <div class="card my-4 box-shadow">
                            <img class="card-img-top" src="{{ asset('web_assets/images/current_campaing_img1.png') }}"
                                alt="Card image cap">
                            <div class="card-body" style="padding-left: 10px;">
                                <!-- <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p> -->
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group" style="display: block !important;">
                                        <h4 class="font-bold" style="font-size: 1.2rem;font-weight: bold;">Pac Rush
                                            Campaign</h4>
                                        <p class="card-text" style="color: red;">Time Remains: 2d 1h 23m</p>
                                    </div>
                                    <a type="btn" class="btn  btn-outline-secondary text-white common-btn "
                                        href="#">Play now</a>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-4 col-sm-12">
                        <div class="card my-4 box-shadow">
                            <img class="card-img-top" src="{{ asset('web_assets/images/current_campaing_img2.png') }}"
                                alt="">
                            <div class="card-body" style="padding-left: 10px;">

                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group" style="display: block !important;">
                                        <h4 class="font-bold" style="font-size: 1.2rem;
    font-weight: bold;">Pac Rush
                                            Campaign</h4>
                                        <p class="card-text" style="color: red; ">Time Remains: 2d 1h 23m</p>
                                    </div>
                                    <a type="btn" class="btn btn-outline-secondary common-btn text-white"
                                        href="#">Play now</a>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-4 col-sm-12">
                        <div class="card my-4 box-shadow">
                            <img class="card-img-top" src="{{ asset('web_assets/images/current_campaing_img2.png') }}"
                                alt="">
                            <div class="card-body" style="padding-left: 10px;">

                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group" style="display: block !important;">
                                        <h4 class="font-bold" style="font-size: 1.2rem;
    font-weight: bold;">Pac Rush
                                            Campaign</h4>
                                        <p class="card-text" style="color: red; ">Time Remains: 2d 1h 23m</p>
                                    </div>
                                    <a type="btn" class="btn btn-outline-secondary common-btn text-white"
                                        href="#">Play now</a>
                                </div>
                            </div>
                        </div>
                    </div>

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
                    <div class="col-md-4 col-sm-12 mt-2">
                        <div class="campain-body">
                            <div class="row row-cols-1 row-cols-sm-2">
                                <div class="col-6">
                                    <figure style="margin: 0px;">
                                        <img class="card-img" src="{{ asset('web_assets/images/turnament_img1.png') }}"
                                            alt="Card image" />
                                    </figure>
                                </div>
                                <div class="col-6" style="margin-top: 6%;">
                                    <div class="card-body-right">
                                        <h4 class="card-title font-bold" style="font-weight: bold; font-size: 1.3rem;">
                                            Snap Card Game</h4>
                                        <p class="card-text " style="color: green;">Starts in : 2d 1h 23m</p>
                                        <a href="#" class="btn btn-primary  common-btn">Explore now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 mt-2">
                        <div class="campain-body">
                            <div class="row row-cols-1 row-cols-sm-2">
                                <div class="col-6">
                                    <figure style="margin: 0px;">
                                        <img class="card-img" src="{{ asset('web_assets/images/turnament_img1.png') }}"
                                            alt="Card image" />
                                    </figure>
                                </div>
                                <div class="col-6" style="margin-top: 6%;">
                                    <div class="card-body-right">
                                        <h4 class="card-title font-bold" style="font-weight: bold; font-size: 1.3rem;">
                                            Snap Card Game</h4>
                                        <p class="card-text " style="color: green;">Starts in : 2d 1h 23m</p>
                                        <a href="#" class="btn btn-primary  common-btn">Explore now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 mt-2">
                        <div class="campain-body">
                            <div class="row row-cols-1 row-cols-sm-2">
                                <div class="col-6">
                                    <figure style="margin: 0px;">
                                        <img class="card-img" src="{{ asset('web_assets/images/turnament_img1.png') }}"
                                            alt="Card image" />
                                    </figure>
                                </div>
                                <div class="col-6" style="margin-top: 6%;">
                                    <div class="card-body-right">
                                        <h4 class="card-title font-bold" style="font-weight: bold; font-size: 1.3rem;">
                                            Snap Card Game</h4>
                                        <p class="card-text " style="color: green;">Starts in : 2d 1h 23m</p>
                                        <a href="#" class="btn btn-primary  common-btn">Explore now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!--/ Section one End /-->

    </main>
@endsection


{{-- scripts --}}
@push('scripts')
@endpush

@extends('layouts.app_public', ['title' => 'Tournament'])

@section('styles')
@endsection

@section('content')

<main role="main">



    <!--/ Section one Star /-->
    <section id="account-panel">
      <div class="container-fluid">
        <div class="wrap-one  d-flex justify-content-between">
          <div class="title-box">

          </div>
        </div>
        <div class="row justify-content-center mb-5">
          <div class="col-5">
            <img src="{{asset('web_assets/images/account.png')}}" alt="" title="" style="width: 100%; margin-bottom: 5%;">
            <p class="text-center font-bold" style="font-size: 1.5rem;">01710xxxxxx</p>
          </div>

        </div>
      </div>
    </section>
    <!--/ Section one End /-->
    <!--/ Section two Star /-->
    <section id="section_two" style="margin-bottom: 30%;">
      <div class="container-fluid">
        <div class="wrap-one  d-flex justify-content-between">
          <div class="title-box">
            <h3 class="title-a my-2">My Tournaments</h3>
          </div>
        </div>
        <div class="row ">
          <div class="col-md-12">

            <div class="campain-body">
              <div class="row row-cols-1 row-cols-sm-2">

                <div class="col-6">
                  <figure style="margin: 0px;">
                    <img class="card-img" src="{{asset('web_assets/images/turnament_img1.png')}}" alt="Card image" />
                  </figure>
                </div>
                <div class="col-6" style="margin-top: 6%;">
                  <div class="card-body-right">
                    <h4 class="card-title font-bold" style="font-weight: bold; font-size: 1.3rem;">Snap Card Game</h4>
                    <p class="card-text " style="color: red;">Starts in : 2d 1h 23m</p>
                    <a href="#" class="btn btn-primary  common-btn" style="margin-bottom: 2%;">Play now</a><br>
                    <a href="#" class="btn btn-primary  leaderbord">
                      <img src="{{asset('web_assets/images/leaderboard.png')}}" alt="" title="">
                      Leaderboard
                    </a>
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

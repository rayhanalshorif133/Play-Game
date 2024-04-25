@extends('layouts.app_public', ['title' => 'Tournament'])

@section('styles')
@endsection

@section('content')

<main role="main">

    <!--/ Section one Star /-->
    <section id="account-panel">
      <div class="container">
        <div class="wrap-one  d-flex justify-content-between">
          <div class="title-box">

          </div>
        </div>
        <div class="row justify-content-center mb-5">

          <div class="col-5 d-flex justify-content-center">
            @if(Auth::user()->avatar)
            <img src="{{Auth::user()->avatar}}" alt="" title="" style="width: 250px; height: 350px; margin-bottom: 5%; text-align: center;">
            @else
            <img src="{{asset('web_assets/images/account.png')}}" alt="" title="" style="width: 250px; height: 350px; margin-bottom: 5%; text-align: center;">
            @endif
          </div>
        <div class="col-12">

          <p class="text-center font-bold" style="font-size: 1.5rem;">{{ Auth::user()->msisdn }}</p>
          <a class="btn btn-primary common-btn w-full py-2 mb-2" href="{{ route('account.update') }}">
            Edit Account
          </a>
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
            <h3 class="title-a my-2">My Tournaments</h3>
          </div>
        </div>

        <div class="row">

          <div class="col-md-4 col-sm-12" style="margin-bottom: 3%;">
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
                    <p class="card-text " style="color: green;">Starts in : 2d 1h 23m</p>
                    <a href="#" class="btn btn-primary  common-btn">Explore now</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4 col-sm-12" style="margin-bottom: 3%;">
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
                    <p class="card-text " style="color: green;">Starts in : 2d 1h 23m</p>
                    <a href="#" class="btn btn-primary  common-btn">Explore now</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4 col-sm-12">
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

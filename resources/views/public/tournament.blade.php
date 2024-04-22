@extends('layouts.app_public', ['title' => 'Tournament'])

@section('styles')
@endsection

@section('content')
<main role="main">

    <!--/ Section tournament Star /-->
    <section id="tournament-panel" style="margin-bottom: 30%;">
      <div class="container-fluid">
        <div class="row my-4">
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
                    <a href="{{route('leaderboard.index')}}" class="btn btn-primary  leaderbord">
                      <img src="{{asset('web_assets/images/leaderboard.png')}}" alt="" title="">
                      Leaderboard
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- ----------------------------------- -->
        <div class="row my-4 ">
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
                    <a href="{{route('leaderboard.index')}}" class="btn btn-primary  leaderbord">
                      <img src="{{asset('web_assets/images/leaderboard.png')}}" alt="" title="">
                      Leaderboard
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- ----------------------------------- -->
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
                    <a href="{{route('leaderboard.index')}}" class="btn btn-primary  leaderbord">
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
    <!--/ Section tournament End /-->

  </main>
@endsection
{{-- scripts --}}
@push('scripts')
@endpush

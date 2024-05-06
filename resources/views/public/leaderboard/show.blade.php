@extends('layouts.app_public', ['title' => 'Leaderboard'])

@section('styles')
    <style type="text/css">

    </style>
@endsection

@section('content')
<div class="wrapper">
    <section id="top-leaderbord">
       <div class="container">
          <div class="row justify-content-center mt-10">
            <div class="w-full text-center leaderboard_title">
               <h2 class="font-weight-bold common-bg"
                  style="font-size: calc(1.8em + 1vmin); color: #fff;">Leaderboard</h2>
            </div>
             <div class="col-12 py-3">
                <div class="tap-header">
                   <ul class="nav nav-pills mb-3 justify-content-center " id="pills-tab" role="tablist">
                      <li class="nav-item" role="presentation">
                         <a class="nav-link  text-center active" id="pills-daily-tab" data-toggle="pill"
                            href="#pills-daily" role="tab" aria-controls="pills-daily" aria-selected="true">Daily</a>
                      </li>
                      <li class="nav-item " role="presentation">
                         <a class="nav-link  text-center" id="pills-weekly-tab" data-toggle="pill"
                            href="#pills-weekly" role="tab" aria-controls="pills-weekly"
                            aria-selected="false">Grand</a>
                      </li>
                   </ul>
                </div>
                <div class="tab-content justify-content-center" id="pills-tabContent">
                   <div class="tab-pane fade show active" id="pills-daily" role="tabpanel"
                      aria-labelledby="pills-daily-tab">
                      <div id="score-panel">

                         <div class="tab-content" style="margin-bottom: 5%;">
                            <div class="tab-pane fade show active" id="one" role="tabpanel" aria-labelledby="one-tab">
                               <div class="score-bord-panel">
                                  <div class="table-wrapper-scroll-y my-custom-scrollbar">

                                     <!-- ================================== -->
                                     <div class="title-panel mb-3">
                                        <div class="row row-cols-1 row-cols-sm-3 border-b-slate-200">
                                           <div class="col-3">
                                              <p class="number font-weight-bold" style="padding-left: 2%;">
                                                 Renking
                                              </p>
                                           </div>
                                           <div class="col-6 d-block text-center clock">
                                              <p class="second text-black font-weight-bold">Phone</p>
                                           </div>

                                           <div class="col-3 d-block text-center score" style="padding: 0px;">
                                              <p class="d-block text-black font-weight-bold">Score</p>
                                           </div>
                                        </div>
                                     </div>
                                     <!-- ================================== -->
                                     <div class="score-body scroll-container">
                                       
                                       @foreach($daily_scores as $score)
                                        <!-- ================================== -->
                                        <div class="score-part mb-3">
                                           <div class="row row-cols-1 row-cols-sm-3">
                                              <div class="col-3">
                                                 <p class="number">
                                                    {{$loop->index + 1}}
                                                 </p>
                                              </div>
                                              <div class="col-6  d-block text-center clock">

                                                 <p class="second text-center">
                                                   {{hideMiddleDigits($score->msisdn)}}
                                                 </p>
                                              </div>

                                              <div class="col-3  d-block text-center clock">

                                                 <p class="second">{{$score->score}}</p>
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
                   <div class="tab-pane fade" id="pills-weekly" role="tabpanel" aria-labelledby="pills-weekly-tab">
                      <div id="score-panel">
                         <div class="tab-content" style="margin-bottom: 5%;">
                            <div class="tab-pane fade show active" id="one" role="tabpanel" aria-labelledby="one-tab">
                               <div class="score-bord-panel">
                                  <div class="table-wrapper-scroll-y my-custom-scrollbar">

                                     <!-- ================================== -->
                                     <div class="title-panel mb-3">
                                        <div class="row row-cols-1 row-cols-sm-3 border-b-slate-200">
                                           <div class="col-3">
                                              <p class="number font-weight-bold" style="padding-left: 2%;">
                                                 Renking
                                              </p>
                                           </div>
                                           <div class="col-6 d-block text-center clock">
                                              <p class="second text-black font-weight-bold">Phone</p>
                                           </div>

                                           <div class="col-3 d-block text-center score" style="padding: 0px;">
                                              <p class="d-block text-black font-weight-bold">Score</p>
                                           </div>
                                        </div>
                                     </div>
                                     <!-- ================================== -->
                                     <div class="score-body scroll-container">
                                       @foreach($grandly_scores as $score)
                                        <!-- ================================== -->
                                        <div class="score-part mb-3">
                                           <div class="row row-cols-1 row-cols-sm-3">
                                              <div class="col-3">
                                                 <p class="number">
                                                    {{$loop->index + 1}}
                                                 </p>
                                              </div>
                                              <div class="col-6  d-block text-center clock">

                                                 <p class="second text-center">
                                                   {{hideMiddleDigits($score->msisdn)}}
                                                 </p>
                                              </div>

                                              <div class="col-3  d-block text-center clock">

                                                 <p class="second">{{$score->score}}</p>
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
@endsection


{{-- scripts --}}
@push('scripts')
@endpush

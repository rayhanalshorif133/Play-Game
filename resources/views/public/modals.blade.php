 {{-- paymentSuccessModal --}}
 <div class="modal fade" id="paymentSuccessModal" tabindex="-1" aria-labelledby="paymentSuccessModalLabel"
     aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content payment_model">
             <div class="status"><i class="fa-solid fa-circle-check"></i></div>
             <div class="content">
                 <div class="modal-body d-flex justify-content-center" style="margin-top: 3.2rem">
                     <img src="{{ asset('images/payment_success.png') }}" style="width:13rem; height:auto" />
                 </div>
                 <div class="mx-auto w-full d-flex justify-content-center" style="margin-top: 2.8rem">
                     <div class="btn_secondary" style="width: 7rem!important">
                         <button data-bs-dismiss="modal" class="btn payment_close_btn">Close</button>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>

 {{-- paymentFailedModal --}}
 <div class="modal fade" id="paymentFailedModal" tabindex="-1" aria-labelledby="paymentFailedModalLabel"
     aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content payment_model">
             <div class="status"><i class="fa-solid fa-circle-exclamation"></i></div>
             <div class="content">
                 <div class="modal-body d-flex flex-column justify-content-center ooops_container"
                     style="margin-top: 3.2rem">
                     <h1>Ooops!</h1>
                     <p>Payment failed</p>
                 </div>
                 <div class="mx-auto w-full d-flex justify-content-center" style="margin-top: 2.8rem">
                     <div class="btn_secondary" style="width: 7rem!important">
                         <button data-bs-dismiss="modal" class="btn payment_try_again_btn">Try Again</button>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>

 <div class="modal fade" id="leaderboadModal_old" tabindex="-1" aria-labelledby="leaderboadModalLabel"
     aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content leaderboard">
             <div class="modal_header">
                 <h5 class="modal_title" id="leaderboardModalLabel">Leaderboard</h5>
                 <div class="close_btn" style="border-radius: 50%;">
                     <button type="button" class="close custom-close" style="border-radius: 50%;"
                         data-bs-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
             </div>
             <div class="modal_body">
                 <table>
                     <thead>
                         <tr>
                             <th>Rank</th>
                             <th>User No</th>
                             <th>Score</th>
                         </tr>
                     </thead>
                     @if (count($scores) == 0)
                         <tbody>
                             <tr>
                                 <td>No data found</td>
                             </tr>
                         </tbody>
                     @else
                         <tbody class="leaderboard">
                             <tr class="highlight"></tr>
                             @foreach ($scores as $index => $item)
                                 <tr class="@if ($msisdn == $item->msisdn) active @endif"
                                     data-position={{ $index + 1 }}>
                                     <td>{{ $index + 1 }}</td>
                                     <td>{{ substr($item->msisdn, 0, 5) . str_repeat('*', 5) . substr($item->msisdn, -3) }}
                                     </td>
                                     <td>{{ $item->total_score }}</td>
                                 </tr>
                             @endforeach
                         </tbody>
                     @endif
                 </table>
             </div>
         </div>
     </div>
 </div>

 <div class="modal fade" id="leaderboadModal" tabindex="-1" aria-labelledby="insertUserModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content tournament_rules">
             <div class="modal-header">
                 <h5 class="modal-title" id="tournamentModalLabel">Leaderboard</h5>
             </div>
             <div class="modal-body">
                 <div class="nav_container">
                     <div class="nav_item daily">
                         <button class="active btn">Daily</button>
                     </div>
                     <div class="nav_item weekly">
                         <button class="btn">Weekly</button>
                     </div>
                 </div>
                 <div class="daily_container leaderboard_container">
                     <table>
                         <thead>
                             <tr style="padding: 0 10px">
                                 <th>Rank</th>
                                 <th>User No</th>
                                 <th>Score</th>
                             </tr>
                         </thead>
                         @if (count($scores) == 0)
                             <tbody>
                                 <tr>
                                     <td>No data found</td>
                                 </tr>
                             </tbody>
                         @else
                             <tbody>
                                 <tr class="highlight"></tr>
                                 @foreach ($scores as $index => $item)
                                     <tr class="@if ($msisdn == $item->msisdn) active @endif"
                                         data-position={{ $index + 1 }}>
                                         <td>
                                             @if ($msisdn == $item->msisdn)
                                                 👨🏼‍💼
                                             @else
                                                 {{ $index + 1 }}
                                             @endif
                                         </td>
                                         <td>{{ substr($item->msisdn, 0, 5) . str_repeat('*', 5) . substr($item->msisdn, -3) }}
                                         </td>
                                         <td class="d-flex">{{ $item->total_score }}
                                         </td>
                                     </tr>
                                 @endforeach
                             </tbody>
                         @endif
                     </table>
                 </div>
                 <div class="weekly_container d-none leaderboard_container">
                     <table>
                         <thead>
                             <tr style="padding: 0 10px">
                                 <th>Rank</th>
                                 <th>User No</th>
                                 <th>Score</th>
                             </tr>
                         </thead>
                         @if (count($weekly_scores) == 0)
                             <tbody>
                                 <tr>
                                     <td>No data found</td>
                                 </tr>
                             </tbody>
                         @else
                             <tbody>
                                 <tr class="highlight"></tr>
                                 @foreach ($weekly_scores as $index => $item)
                                     <tr class="@if ($msisdn == $item->msisdn) active @endif"
                                         data-position={{ $index + 1 }}>
                                         <td>

                                             @if ($msisdn == $item->msisdn)
                                                 👨🏼‍💼
                                             @else
                                                 {{ $index + 1 }}
                                             @endif


                                         </td>
                                         <td>{{ substr($item->msisdn, 0, 5) . str_repeat('*', 5) . substr($item->msisdn, -3) }}
                                         </td>
                                         <td class="d-flex">{{ $item->total_score }}

                                         </td>
                                     </tr>
                                 @endforeach
                             </tbody>
                         @endif
                     </table>
                 </div>
             </div>
         </div>
     </div>
 </div>





 <div class="modal fade" id="tournamentRulesModal" tabindex="-1" aria-labelledby="tournamentRulesModalLabel"
     aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content tournament_rules">
             <div class="modal-header">
                 <h5 class="modal-title" id="tournamentModalLabel">Tournament Rules</h5>
             </div>
             <div class="modal-body">
                 <ol class="px-4">
                     <li>The Campaigns will run for 7 days.</li>
                     <li>The campaign will begin on Monday and end on Sunday.</li>
                     <li>Users need to register for the campaign every day.</li>
                     <li>If the user plays once during the campaign, they will be considered a contender for the weekly
                         prize.</li>
                     <li>Registration fee for the campaign is Tk. 10 per day.</li>
                     <li>Users can play as many times as they want during the tournament period.</li>
                     <li>The leaderboard will show the top 15 scorers and the player's current position.</li>
                     <li>The tournament will start at 10:00 AM and close at 11:59 PM each day.</li>
                 </ol>
                 <h1 class="normal_title">Help and Support</h1>
                 <h2 class="normal_text">Email: cservice@b2m-tech.com, Phone: +880 1725298711</h2>


                 <div class="mx-auto w-full d-flex justify-content-center" style="margin-top: 2.8rem">
                     <div class="btn_secondary" style="width: 7rem!important">
                         <button data-bs-dismiss="modal" class="btn">Close</button>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>

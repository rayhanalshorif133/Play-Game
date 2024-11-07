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

 <div class="modal fade" id="leaderboadModal" tabindex="-1" aria-labelledby="leaderboadModalLabel" aria-hidden="true">
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


 <div class="modal fade" id="tournamentRulesModal" tabindex="-1" aria-labelledby="tournamentRulesModalLabel"
     aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content tournament_rules">
             <div class="modal-header">
                 <h5 class="modal-title" id="tournamentModalLabel">Tournament Rules</h5>
             </div>
             <div class="modal-body">
                 <ol class="px-4">
                     <li>নিবন্ধন: সময়মত নিবন্ধন ও ফি প্রদান।</li>
                     <li>দলের আকার: নির্ধারিত সদস্য সংখ্যা অনুযায়ী দল গঠন।</li>
                     <li>সময়সূচি: নির্ধারিত সময়ে উপস্থিতি বাধ্যতামূলক।</li>
                     <li>নিয়ম মেনে খেলা: অফিসিয়াল নিয়ম অনুসরণ করা আবশ্যক।</li>
                     <li>রেফারির সিদ্ধান্ত: রেফারির সিদ্ধান্ত চূড়ান্ত।</li>
                     <li>আচরণ: শৃঙ্খলা ও ভালো আচরণ বজায় রাখা।</li>
                     <li>অভিযোগ: নির্ধারিত প্রক্রিয়ায় অভিযোগ দাখিল।</li>
                     <li>পুরস্কার: বিজয়ী ও দ্বিতীয় স্থানেও পুরস্কার।</li>
                     <li>ডিসকোয়ালিফিকেশন: নিয়ম লঙ্ঘনে দল বাদ পড়তে পারে।</li>
                     <li>আয়োজকদের অধিকার: নিয়ম পরিবর্তনের অধিকার আয়োজকদের।</li>
                 </ol>
                 <div class="mx-auto w-full d-flex justify-content-center" style="margin-top: 2.8rem">
                     <div class="btn_secondary" style="width: 7rem!important">
                         <button data-bs-dismiss="modal" class="btn">Close</button>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>




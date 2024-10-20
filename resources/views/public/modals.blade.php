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
                     <div class="btn_secondary mx-2" style="width: 7rem!important">
                         <button data-bs-dismiss="modal" class="btn payment_close_btn">Close</button>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>

 <div class="modal fade" id="leaderboadModal" tabindex="-1" aria-labelledby="leaderboadModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content leaderboard">
             <div class="modal-header" style="background-color: var(--primary-color); color: white;">
                 <h5 class="modal-title" id="leaderboardModalLabel">Leaderboard</h5>
                 <button type="button" class="close custom-close" data-bs-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <table class="table">
                     <thead>
                         <tr>
                             <th scope="col">#</th>
                             <th scope="col">Name</th>
                             <th scope="col">Score</th>
                         </tr>
                     </thead>
                     <tbody>
                         <tr>
                             <td scope="row">1</td>
                             <td>Alice</td>
                             <td>1500</td>
                         </tr>
                         <tr>
                             <td scope="row">2</td>
                             <td>Bob</td>
                             <td>1400</td>
                         </tr>
                         <tr>
                             <td scope="row">3</td>
                             <td>Charlie</td>
                             <td>1300</td>
                         </tr>
                         <tr>
                             <td scope="row">4</td>
                             <td>David</td>
                             <td>1200</td>
                         </tr>
                         <tr>
                             <td scope="row">5</td>
                             <td>Eve</td>
                             <td>1100</td>
                         </tr>
                     </tbody>
                 </table>
             </div>
         </div>
     </div>
 </div>


 <div class="modal fade" id="tournamentRulesModal" tabindex="-1" aria-labelledby="tournamentRulesModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content tournament_rules">
             <div class="modal-header" style="background-color: var(--primary-color); color: white;">
                 <h5 class="modal-title" id="tournamentModalLabel">Tournament Rules</h5>
                 <button type="button" class="close custom-close" data-bs-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body my-3">
                <h6 class="px-4"><strong>টুর্নামেন্ট নিয়মাবলী</strong></h6>
                <ol class="px-4">
                    <li><strong>অযোগ্যতা:</strong> অংশগ্রহণকারীদের নিবন্ধিত খেলোয়াড় হতে হবে এবং টুর্নামেন্ট নির্দেশিকায় উল্লেখিত বয়সের শর্তগুলি পূরণ করতে হবে।</li>
                    <li><strong>দল গঠন:</strong> প্রতিটি দলে কমপক্ষে ৩ এবং সর্বাধিক ৫ জন খেলোয়াড় থাকতে হবে। পরিবর্তনশীলদের জন্য নিয়মাবলী অনুযায়ী অনুমতি দেওয়া হবে।</li>
                    <li><strong>ম্যাচের ফরম্যাট:</strong> ম্যাচগুলি তিনটি সেটের মধ্যে সেরা বিজেতা হিসেবে খেলা হবে। প্রথম দল যে দুটি ম্যাচ জিতবে, তারা এগিয়ে যাবে।</li>
                    <li><strong>আচরণবিধি:</strong> সকল খেলোয়াড়দের ভাল খেলার মনোভাব প্রদর্শন করতে হবে। হয়রানি বা প্রতারণার কোন ধরনের ঘটনা ডিপোজিটের জন্য কারণ হবে।</li>
                    <li><strong>গেম সেটিংস:</strong> সমস্ত গেম টুর্নামেন্টের নির্দেশাবলীতে নির্ধারিত গেম সেটিংস অনুযায়ী খেলা হতে হবে।</li>
                    <li><strong>বিরোধ:</strong> যেকোনো বিরোধের বিষয়ে তৎক্ষণাৎ টুর্নামেন্ট সংগঠকদের কাছে রিপোর্ট করতে হবে। তাদের সিদ্ধান্ত চূড়ান্ত হবে।</li>
                    <li><strong>পুরস্কার:</strong> প্রথম তিনটি দলের মধ্যে পুরস্কার বিতরণ করা হবে যা টুর্নামেন্ট ঘোষণায় উল্লেখিত।</li>
                    <li><strong>সময়সূচী:</strong> অংশগ্রহণকারীদের টুর্নামেন্টের সময়সূচী মেনে চলতে হবে। দেরিতে আসলে স্বয়ংক্রিয়ভাবে অযোগ্য হতে পারে।</li>
                    <li><strong>স্ট্রিমিং:</strong> ম্যাচগুলি সরাসরি সম্প্রচার করা হতে পারে। অংশগ্রহণের মাধ্যমে, আপনি রেকর্ড করা বা সম্প্রচারিত হওয়ার জন্য সম্মতি দেন।</li>
                </ol>
             </div>
         </div>
     </div>
 </div>

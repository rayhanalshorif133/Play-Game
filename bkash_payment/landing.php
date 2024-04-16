<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Landing page</title>
      <link href='https://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" integrity="sha512-BnbUDfEUfV0Slx6TunuB042k9tuKe3xrD6q4mg5Ed72LTgzDIcLPxg6yI2gcMFRyomt+yJJxE+zJwNmxki6/RA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
      <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
   </head>
   <body>
      <section id="top-panel">
         <div class="container-fluid">
            <div class="row justify-content-end">
               <div class="col-12 sm-12">
                  <div class="card text-white">
                     <div class="cat-banner-image">
                        <p style="cursor:pointer" class="quiz-text d-block text-right ld-bord"  data-toggle="modal" data-target="#score">                            
                           <img src="<?= base_url('assets/images/trofy-icon.png') ?>" class="img-responsive fluid-img">
                        </p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <section id="middel-panel" style="margin-top: 10%;">
         <div class="container-fluid">
            <div class="row justify-content-center">
               <div class="col-10 sm-10">
                  <div id="middel-box">
                     <figure class="text-center d-block">
                        <img src="<?= base_url('assets/images/pac-rush-logo.png') ?>" class="img-fluid img-responsive">
                     </figure>
                     <div class="score-time text-white">
                        <div class="row">
                           <div class="col-auto mr-auto" >
                              <p><i class="fas fa-gamepad"></i> <?= number_format(($total_paly+$total_free_paly)/1000000,2) ?>M</p>
                           </div>
                           <div class="col-auto">
                              <p><i class="far fa-clock"></i> 
								<span id="counter" style="font-size:12px !important"></span>
							  </p>
                           </div>
                        </div>
                     </div>
                     <div class="play-buttton"   style="cursor: pointer;">
                        <div class="row justify-content-center">
                           <div class="col-md-6 m-auto">
                              <a <?= ($payment != NULL)?'href="'.base_url('PacRush/paly_game/'.$msisdn).'"':'id="myBtn"' ?>>
                                 <img src="<?= base_url('assets/images/play-btn.png') ?>"  class="img-fluid img-responsive">
                              </a>
                           </div>
                        </div>
                     </div>
                     <div class="terms-leader">
                        <div class="row justify-content-center">
                           <div class="col-12 ">
                              <div class="card text-white">
                                 <div class="terms-banner-image">
                                    <p class="btn d-block text-center text-white" data-toggle="modal" data-target="#staticBackdrop">
                                       <i class='fas fa-clipboard-list'></i>  Tournament Rules
                                    </p>
                                 </div>
                              </div>
                           </div>
                           <div class="col-12 ">
                              <div class="condition-banner-image">
                                 <a href="<?= base_url('PacRush/leaderboard/PacRush/'.$msisdn) ?>" class="quiz-text d-block text-center text-white">
                                 <i class="fas fa-cash-register"></i>  Leaderboard
                                 </a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- middel-box -->
            </div>
         </div>
      </section>
      <section>
         <div class="container-fluid">
            <div class="row">
               <div class="col">
               </div>
               <div class="col-10 text-center" style="background-color: #f6dee9; padding: 20px 10px 0px 10px; border-radius: 10px; box-shadow: #ccc 2px 4px 5px; margin-bottom: 10%;">
                  <p>প্রিয় গেমারস, সবাইকে ঈদ মোবারক। প্যাক রাশ গেমস এর সাপ্তাহিক টুর্নামেন্ট যথারীতি চলমান থাকবে। তবে  ঈদুল ফিতর উপলক্ষে যেহেতু বিকাশ ও প্যাক রাশ গেমস পরিচালনাকারী প্রতিষ্ঠান B2M Technologies Ltd বন্ধ থাকবে তাই উক্ত সময়ের বিজয়ীদের পুরষ্কার ১৫ই - ১৭ই এপ্রিলের মাঝে যথাযথ ভাবে প্রদান করা হবে। প্যাক রাশ গেমস এর সাথে থাকার জন্য ধন্যবাদ। </p>
               </div>
               <div class="col">
               </div>
            </div>
            <div class="row justify-content-center">
               <div class="col">
               </div>
               <div class="col-10 sm-10 bottom-banner">
                  <img src="<?= base_url('assets/images/weekly.png') ?>" class="fluid-img img-responsive">
               </div>
               <div class="col">
               </div>
            </div>
         </div>
         <div class="container-fluid">
            <div class="row justify-content-center">
               <div class="col-12">
                  <p style="text-align:center; margin-top:4% ">All Right Reserved to <a href=""><img src="<?= base_url('assets/images/b2m-logo.png') ?>" class="fluid-img"></a></p>
               </div>
            </div>
         </div>
      </section>
      <!-- The Modal -->
      <div id="myModal"  class="modal" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
         <!-- Modal content -->
         <div class="modal-content">
            <div class="modal-header ">
               <div class="popup-top-icon justify-content-center">
                  <img src="<?= base_url('assets/images/popup-top-icon.png') ?>" class="img-fluid img-responsive" >
               </div>
            </div>
            <div class="modal-body">
               
			   <div class="body-part-one mb-2">
                  <h2 class="text-center d-block font-weight-bold" style="margin-bottom: 2%; padding-top: 0%; margin-top: 2%; font-size: 14px;">Play & win total Tk 6750/week</h2>
                  <div class="container">
                     <div class="row justify-content-between">
                        <div class="left-side-box col-5">
                           
                           <div class="win-cash">
                              <p>Tournament <br/> <small style="font-size:8px">Daily REG. Fee Tk. 10</small></p>
                           </div>
                           <div class="left-score-time">
                              <div class="row">
                                 <div class="col-auto mr-auto" >
                                    <p><i class="fas fa-gamepad"></i> <?= number_format($total_paly/1000000,2) ?>M</p>
                                 </div>
								 <div class="col-auto mr-auto text-right">
									  <p><i class="far fa-clock"></i> 
										<span id="counter1" style="font-size:2.2vw !important"></span>
									  </p>
								   </div>
                              </div>
                           </div>
                           <div class="left-play-buttton">
                              <div class="row justify-content-center">
                                 <a href="#" style="text-decoration:none; font-size:15px; color:#FFF; paddding: 2px" id="bKash_button">REG</a>
                              </div>
                           </div>
                        </div>
						
                        <div class="right-side-box col-5">
                           <?php if($user_free_play_count >= 5){ ?>
                           <p style="font-size:8px; line-height: 10px !important; text-align:center">Your trial limit is finished.</p>
                           <?php } ?>
                           <div class="win-cash">
                              <p>
                                 Trial
                              </p>
                           </div>
                           <div class="right-score-time">
                              <div class="row">
                                 <div class="col-auto mr-auto" >
                                    <p><i class="fas fa-gamepad"></i> <?= number_format($total_free_paly/1000000,2) ?>M</p>
                                 </div>
								
								   <div class="col-auto">
									  <p><i class="far fa-clock"></i> 
										<span id="counter2" style="font-size:2.2vw !important"></span>
									  </p>
								   </div>
                              </div>
                           </div>

                           <div class="right-play-buttton">
                              <div class="row justify-content-center">
                                 <?php if($user_free_play_count < 5){ ?>
                                 <a href="<?= base_url('PacRush/paly_game/'.$msisdn) ?>">
                                 <img src="<?= base_url('assets/images/play-btn-mini.png') ?>" class="fluid-img img-responsive">
                                 </a>
                                 <?php }else{ ?>
                                 <a   onclick="call_bkash_button()" href="#">
                                 <img src="<?= base_url('assets/images/play-btn-mini.png') ?>" class="fluid-img img-responsive">
                                 </a>
                                 <?php } ?>
                              </div>
                           </div>

                                 
                        </div>
                     </div>
                  </div>
               </div>
			   
               <div class="body-part-two">
                  <div class="prize">
                     <h3 class="text-center d-block font-weight-bold text-white">Prize</h3>
                  </div>
                  <div class="scroll-body">
                     <div class="score-money mb-2">
                        <div class="row">
                           <div class="col-auto mr-auto" >
                              <p>Daily top 25 scorer</p>
                           </div>
                           <div class="col-auto">
                              <div class="prize-taka">
                                 <p>TK 20</p>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="score-money mb-2">
                        <div class="row">
                           <div class="col-auto mr-auto" >
                              <p>Weekly 1st top scorer</p>
                           </div>
                           <div class="col-auto">
                              <div class="prize-taka">
                                 <p>TK 1000</p>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="score-money mb-2">
                        <div class="row">
                           <div class="col-auto mr-auto" >
                              <p>Weekly 2nd top scorer</p>
                           </div>
                           <div class="col-auto">
                              <div class="prize-taka">
                                 <p>TK 750 </p>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="score-money mb-2">
                        <div class="row">
                           <div class="col-auto mr-auto" >
                              <p>Weekly 3rd top scorer</p>
                           </div>
                           <div class="col-auto">
                              <div class="prize-taka">
                                 <p>TK 500 </p>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="score-money mb-2">
                        <div class="row">
                           <div class="col-auto mr-auto" >
                              <p>Weekly 4th to 13rd top scorer</p>
                           </div>
                           <div class="col-auto">
                              <div class="prize-taka">
                                 <p>TK 100 </p>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               
               <div class="row justify-content-center">
                  <div class="play-btn-click">
                     <a href="#" class="text-center d-block"  onclick="call_bkash_button()">Play Now Tk 10</a>
                  </div>
               </div>
				
			</div>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="color:#ececec">&times;</span>
            </button>
         </div>
      </div>
      <!-- =============================== -->
      <!-- <div class="modal-dialog modal-dialog-centered" style="align-items: flex-end;"></div> -->
      <!-- Modal -->
      <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
         <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel">Tournament Rules</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                  <ul>
                     <li>
                        <p><b>1.</b>গেমস খেলে প্রতিদিন পুরস্কার পেতে প্যাক-রাশ গেমটিতে সাবস্ক্রাইব করতে হবে।</p>
                     </li>
                     <li> 
                        <p><b>2.</b> সাবস্ক্রিপশন চার্জ ১০ টাকা মেয়াদ ১ দিন।</p>
                        
                     </li>
                     <li>
                        <p><b>3.</b> ১ দিন মেয়াদ শেষ হয়ে গেলে আবার সাবস্ক্রাইব করতে পারবে, এবং তার পূর্ববর্তী সকল স্কোর রেকর্ড থাকবে। </p>
                     </li> 
                     <li>
                        <p><b>4.</b> প্রতিদিন খেলোয়াড়দের মাঝে শীর্ষ ২৫ জন পাবে ৳২0, টুর্নামেন্ট শেষে শীর্ষ ১৩ জন পুরস্কার হিসেবে পবানে, ১ম স্থান অধিকারি ৳১,০০০ ২য় স্থান অধিকারি ৳৭৫০ ও ৩য় স্থান অধিকারি ৳৫০০। ৪র্থ থেকে ১৩ তম জন পাবেন ১০০ টাকা করে।  </p>
                        
                     </li>
                     <li>
                        <p><b>5.</b> এই অফার টি চলবে ক্যাম্পেইন শুরু হবার ৭  দিন পর্যন্ত এবং খেলার সময় সকাল ১০ টা থেকে রাত ১২টা পর্যন্ত।  </p>
                     </li>
                     <li>
                        <p><b>6.</b>প্রাইজ ঘোষণার ৭২ ঘণ্টার মধ্যে গ্রাহকের বিকাশ নাম্বারে তাদের পুরস্কারের অর্থ পাঠিয়ে দেহা হবে।  </p>
                        
                     </li>
                     <li>
                        <p><b>7.</b> অংশগ্রহণকারীরা প্রথম পেজের উপরে স্থাপিত স্কোর আইকনে ক্লিক করে তাদের দৈনিক, সাপ্তাহিক  অবস্থান ও স্কোর দেখতে পাবেন। এছাড়াও প্রথম পেজের লিডারবোর্ড বাটনে ক্লিক করে ক্যাম্পেইনের ফলাফল ও বিজয়ীদের তালিকা দেখতে পারবে।</p>
                     </li>
                     <li>
                        <p><b>8.</b> এছাড়াও বিস্তারিত জানতে হলে উল্লেখিত ঠিকানায় ই-মেইল অথবা সরাসরি কল করতে পারবে। <br/>
										a.	 cservice@b2m-tech.com <br/>
										 b. 8801680388774, 8801725298711</p>
                        
                     </li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
	  
	  <!-- ======== Score modal========= -->
      <div class="modal fade" id="score" tabindex="-1" role="dialog" aria-labelledby="scoreTitle" aria-hidden="true">
         <div class="modal-dialog  modal-dialog-centered" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Your Score & Rank</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                     <div class="score-bord-panel">
                        <div class="table-wrapper-scroll-y">
                           <table class="table borderless text-center">
                              <thead>
                                 <tr style="border-bottom: 2px solid #FFF;">
                                    <th class="text-center">Type</th>
                                    <th class="text-center">Score</th>
                                    <th class="text-center">Rank</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr  style="border-bottom: 2px solid #FFF;">
									<td>Today</td>
									<td><?= ($today_rank != null)?$today_rank->score:'00' ?></td>
									<td><?= ($today_rank != null)?$today_rank->rank:'00' ?></td>
								</tr>
								<!--<tr  style="border-bottom: 2px solid #FFF;">
									<td>Weekly</td>
									<td><?= ($weekly_rank != null)?$weekly_rank->score:'00' ?></td>
									<td><?= ($weekly_rank != null)?$weekly_rank->rank:'00' ?></td>
								</tr>-->
								<tr  style="border-bottom: 2px solid #FFF;">
									<td>Weekly</td>
									<td><?= ($monthly_rank != null)?$monthly_rank->score:'00' ?></td>
									<td><?= ($monthly_rank != null)?$monthly_rank->rank:'00' ?></td>
								</tr>
                              </tbody>
                           </table>
                        </div>
                     </div>
               </div>
            </div>
         </div>
      </div>
	  
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header bg-danger text-center">
			<h5 class="modal-title text-center text-light" id="exampleModalLabel">Transection Failled!</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body"> 
			<h3 id="model_errorMessage" class="text-center text-danger">Failled!</h3>
		  </div>
		  
		</div>
	  </div>
	</div>
	<button type="button" id="modal_button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" style="display:none">
	  Error MSG
	</button>
	
      <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
      <script type='text/javascript'>
         // Get the modal
         var modal = document.getElementById("myModal");
         var btn = document.getElementById("myBtn");         
         var span = document.getElementsByClassName("close")[0];
         btn.onclick = function() {
           modal.style.display = "block";
         }         
         span.onclick = function() {
           modal.style.display = "none";
         }         
         window.onclick = function(event) {
           if (event.target == modal) {
             modal.style.display = "none"; 
           }
         }	
      </script>
	  
		<script src="<?= base_url('asset/bkash/js/jquery.min.js') ?>"></script>
      <script type="text/javascript">
         
       function call_bkash_button(){
          //$("#bKash_button").click();
          //console.log('test');
          document.getElementById("bKash_button").click();
       }
      </script>
	  
		<script src="https://scripts.pay.bka.sh/versions/1.2.0-beta/checkout/bKash-checkout.js"></script>
		<script>
			var msisdn = '<?= $msisdn ?>';
			var game = '<?= $game ?>';
			var inv_no = Math.floor((Math.random() * 100000) + 1);;
			var paymentID = ''; 
			bKash.init({ 
			  paymentMode: 'checkout', //fixed value ‘checkout’ 
			  //paymentRequest format: {amount: AMOUNT, intent: INTENT} 
			  //intent options 
			  //1) ‘sale’ – immediate transaction (2 API calls) 
			  //2) ‘authorization’ – deferred transaction (3 API calls) 
			  paymentRequest: { 
				amount: '10', //max two decimal points allowed 
				intent: 'sale' 
			  }, 
			  createRequest: function(request) { //request object is basically the paymentRequest object, automatically pushed by the script in createRequest method 
				$.ajax({ 
				  url: 'https://ghoori.b2mwap.com/PacRush/create_payment/'+msisdn, 
				  type: 'POST', 
				  contentType: 'application/json',  
				  success: function(data) { 
					if(data == 'Completed'){
						window.location.href = "https://ghoori.b2mwap.com/PacRush/landing/<?= $msisdn ?>";
						return 0;
					}
					data = JSON.parse(data);
					if (data && data.paymentID != null) { 
					  paymentID = data.paymentID; 
					  bKash.create().onSuccess(data); 
					} else { 
					  bKash.create().onError(); 
					} 
				  }, 
				  error: function() { 
					bKash.create().onError(); 
				  } 
				}); 
			  },
			  executeRequestOnAuthorization: function() { 
				$.ajax({ 
				  url: 'https://ghoori.b2mwap.com/PacRush/execute_payment/'+msisdn+'/'+paymentID, 
				  type: 'POST', 
				  contentType: 'application/json', 
				  data: JSON.stringify({ 
					"paymentID": paymentID
				  }), 
				  success: function(data) { 
					data = JSON.parse(data);
					if (data && data.paymentID != null) { 
						window.location.href = "https://ghoori.b2mwap.com/PacRush/consent_back/"+msisdn+"/"+data.trxID; //Merchant’s success page 
					} else { 
						$('#model_errorMessage').html(data.errorMessage);
						$("#modal_button").click();
					  bKash.execute().onError(); 
					} 
				  }, 
				  error: function() { 
					bKash.execute().onError(); 
				  } 
				}); 
			  },
				onClose: function () {
					  //alert('User has clicked the close button');
				}			  
			});
			
	</script>
	
	<script>
		// Set the date we're counting down to
		var countDownDate = new Date("<?= date('M d, Y H:i:s',strtotime($campaign_data->end_date.' '.$campaign_data->end_time)) ?>").getTime();
		var x = setInterval(function() {
		  var now = new Date().getTime();
		  var distance = countDownDate - now;
		  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
		  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
		  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
		  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
		  document.getElementById("counter").innerHTML = days + "d " + hours + "h "
		  + minutes + "m ";
		  document.getElementById("counter1").innerHTML = days + "d " + hours + "h "
		  + minutes + "m ";
		  document.getElementById("counter2").innerHTML = days + "d " + hours + "h "
		  + minutes + "m ";
		  if (distance < 0) {
			clearInterval(x);
			document.getElementById("counter").innerHTML = "EXPIRED";
			document.getElementById("counter1").innerHTML = "EXPIRED";
			document.getElementById("counter2").innerHTML = "EXPIRED";
		  }
		}, 1000);
	</script>

   </body>
</html>
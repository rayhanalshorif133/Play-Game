<!doctype html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta name="description" content="">
   <meta name="author" content="">
   <link rel="icon" href="favicon.ico">

   <title>Leaderboard</title>
   <!-- Bootstrap core CSS -->

   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
   <link
      href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@200;300;400;500;600;700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
      rel="stylesheet">
   <!-- icon -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
   <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"> -->
   <link rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
   <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" /> -->

   <!-- leaderboard -->
   <link rel="stylesheet" href="{{asset('web_assets/css/leaderboard-more.css')}}">
   <link href="{{asset('ssets/css/style.css')}}" rel="stylesheet">

<body>
   <div class="wrapper">
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
                  <a href="{{route('home')}}" class="justify-content-center text-black d-flex mt-1 mb-3 font-weight-bold"
                     style="font-size: calc(1.8em + 1vmin); color: #fff;">Leaderboard</a>
               </div>
            </div>
            <div class="row justify-content-center">
               <div class="col-12">
                  <div class="tap-header">
                     <ul class="nav nav-pills mb-3 justify-content-center " id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                           <a class="nav-link  text-center active" id="pills-daily-tab" data-toggle="pill"
                              href="#pills-daily" role="tab" aria-controls="pills-daily" aria-selected="true">Daily</a>
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
                                          <div class="score-part mb-3 scroll-page">
                                             <div class="row row-cols-1 row-cols-sm-3">
                                                <div class="col-3">
                                                   <p class="number">
                                                      01
                                                   </p>
                                                </div>
                                                <div class="col-6  d-block text-center">
                                                   <p class="second ">01710****12</p>
                                                </div>

                                                <div class="col-3  d-block text-center ">
                                                   <p class="second ">278</p>
                                                </div>

                                             </div>
                                          </div>
                                          <!-- ================================== -->
                                          <div class="score-part mb-3 scroll-page">
                                             <div class="row row-cols-1 row-cols-sm-3">
                                                <div class="col-3">
                                                   <p class="number">
                                                      02
                                                   </p>
                                                </div>
                                                <div class="col-6  d-block text-center clock">

                                                   <p class="second text-center ">01710****12</p>
                                                </div>

                                                <div class="col-3  d-block text-center clock">

                                                   <p class="second">277</p>
                                                </div>

                                             </div>
                                          </div>

                                          <!-- ================================== -->
                                          <div class="score-part mb-3 scroll-page">
                                             <div class="row row-cols-1 row-cols-sm-3">
                                                <div class="col-3">
                                                   <p class="number">
                                                      03
                                                   </p>
                                                </div>
                                                <div class="col-6  d-block text-center clock">

                                                   <p class="second text-center ">01710****12</p>
                                                </div>

                                                <div class="col-3  d-block text-center clock">

                                                   <p class="second">274</p>
                                                </div>

                                             </div>
                                          </div>

                                          <!-- ================================== -->
                                          <div class="score-part mb-3 scroll-page">
                                             <div class="row row-cols-1 row-cols-sm-3">
                                                <div class="col-3">
                                                   <p class="number">
                                                      04
                                                   </p>
                                                </div>
                                                <div class="col-6  d-block text-center">
                                                   <p class="second ">01710****12</p>
                                                </div>

                                                <div class="col-3  d-block text-center ">
                                                   <p class="second ">272</p>
                                                </div>

                                             </div>
                                          </div>
                                          <!-- ================================== -->
                                          <div class="score-part mb-3 scroll-page">
                                             <div class="row row-cols-1 row-cols-sm-3">
                                                <div class="col-3">
                                                   <p class="number">
                                                      05
                                                   </p>
                                                </div>
                                                <div class="col-6  d-block text-center clock">

                                                   <p class="second text-center ">01710****12</p>
                                                </div>

                                                <div class="col-3  d-block text-center clock">

                                                   <p class="second">270</p>
                                                </div>

                                             </div>
                                          </div>

                                          <!-- ================================== -->
                                          <div class="score-part mb-3 scroll-page">
                                             <div class="row row-cols-1 row-cols-sm-3">
                                                <div class="col-3">
                                                   <p class="number">
                                                      06
                                                   </p>
                                                </div>
                                                <div class="col-6  d-block text-center clock">

                                                   <p class="second text-center ">01710****12</p>
                                                </div>

                                                <div class="col-3  d-block text-center clock">

                                                   <p class="second">260</p>
                                                </div>

                                             </div>
                                          </div>

                                          <!-- ================================== -->
                                          <div class="score-part mb-3 scroll-page">
                                             <div class="row row-cols-1 row-cols-sm-3">
                                                <div class="col-3">
                                                   <p class="number">
                                                      07
                                                   </p>
                                                </div>
                                                <div class="col-6  d-block text-center">
                                                   <p class="second ">01710****12</p>
                                                </div>

                                                <div class="col-3  d-block text-center ">
                                                   <p class="second ">178</p>
                                                </div>

                                             </div>
                                          </div>
                                          <!-- ================================== -->
                                          <div class="score-part mb-3 scroll-page">
                                             <div class="row row-cols-1 row-cols-sm-3">
                                                <div class="col-3">
                                                   <p class="number">
                                                      08
                                                   </p>
                                                </div>
                                                <div class="col-6  d-block text-center clock">

                                                   <p class="second text-center ">01710****12</p>
                                                </div>

                                                <div class="col-3  d-block text-center clock">

                                                   <p class="second">250</p>
                                                </div>

                                             </div>
                                          </div>

                                          <!-- ================================== -->
                                          <div class="score-part mb-3 scroll-page">
                                             <div class="row row-cols-1 row-cols-sm-3">
                                                <div class="col-3">
                                                   <p class="number">
                                                      09
                                                   </p>
                                                </div>
                                                <div class="col-6  d-block text-center clock">

                                                   <p class="second text-center ">01710****12</p>
                                                </div>

                                                <div class="col-3  d-block text-center clock">

                                                   <p class="second">247</p>
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
                                          <div class="score-part mb-3 scroll-page">
                                             <div class="row row-cols-1 row-cols-sm-3">
                                                <div class="col-3">
                                                   <p class="number">
                                                      01
                                                   </p>
                                                </div>
                                                <div class="col-6  d-block text-center">
                                                   <p class="second ">01310****12</p>
                                                </div>

                                                <div class="col-3  d-block text-center ">
                                                   <p class="second ">278</p>
                                                </div>

                                             </div>
                                          </div>
                                          <!-- ================================== -->
                                          <div class="score-part mb-3 scroll-page">
                                             <div class="row row-cols-1 row-cols-sm-3">
                                                <div class="col-3">
                                                   <p class="number">
                                                      02
                                                   </p>
                                                </div>
                                                <div class="col-6  d-block text-center clock">

                                                   <p class="second text-center ">01310****12</p>
                                                </div>

                                                <div class="col-3  d-block text-center clock">

                                                   <p class="second">277</p>
                                                </div>

                                             </div>
                                          </div>

                                          <!-- ================================== -->
                                          <div class="score-part mb-3 scroll-page">
                                             <div class="row row-cols-1 row-cols-sm-3">
                                                <div class="col-3">
                                                   <p class="number">
                                                      03
                                                   </p>
                                                </div>
                                                <div class="col-6  d-block text-center clock">

                                                   <p class="second text-center ">01310****12</p>
                                                </div>

                                                <div class="col-3  d-block text-center clock">

                                                   <p class="second">274</p>
                                                </div>

                                             </div>
                                          </div>

                                          <!-- ================================== -->
                                          <div class="score-part mb-3 scroll-page">
                                             <div class="row row-cols-1 row-cols-sm-3">
                                                <div class="col-3">
                                                   <p class="number">
                                                      04
                                                   </p>
                                                </div>
                                                <div class="col-6  d-block text-center">
                                                   <p class="second ">01310****12</p>
                                                </div>

                                                <div class="col-3  d-block text-center ">
                                                   <p class="second ">272</p>
                                                </div>

                                             </div>
                                          </div>
                                          <!-- ================================== -->
                                          <div class="score-part mb-3 scroll-page">
                                             <div class="row row-cols-1 row-cols-sm-3">
                                                <div class="col-3">
                                                   <p class="number">
                                                      05
                                                   </p>
                                                </div>
                                                <div class="col-6  d-block text-center clock">

                                                   <p class="second text-center ">01310****12</p>
                                                </div>

                                                <div class="col-3  d-block text-center clock">

                                                   <p class="second">270</p>
                                                </div>

                                             </div>
                                          </div>

                                          <!-- ================================== -->
                                          <div class="score-part mb-3 scroll-page">
                                             <div class="row row-cols-1 row-cols-sm-3">
                                                <div class="col-3">
                                                   <p class="number">
                                                      06
                                                   </p>
                                                </div>
                                                <div class="col-6  d-block text-center clock">

                                                   <p class="second text-center ">01310****12</p>
                                                </div>

                                                <div class="col-3  d-block text-center clock">

                                                   <p class="second">260</p>
                                                </div>

                                             </div>
                                          </div>

                                          <!-- ================================== -->
                                          <div class="score-part mb-3 scroll-page">
                                             <div class="row row-cols-1 row-cols-sm-3">
                                                <div class="col-3">
                                                   <p class="number">
                                                      07
                                                   </p>
                                                </div>
                                                <div class="col-6  d-block text-center">
                                                   <p class="second ">01310****12</p>
                                                </div>

                                                <div class="col-3  d-block text-center ">
                                                   <p class="second ">178</p>
                                                </div>

                                             </div>
                                          </div>
                                          <!-- ================================== -->
                                          <div class="score-part mb-3 scroll-page">
                                             <div class="row row-cols-1 row-cols-sm-3">
                                                <div class="col-3">
                                                   <p class="number">
                                                      08
                                                   </p>
                                                </div>
                                                <div class="col-6  d-block text-center clock">

                                                   <p class="second text-center ">01310****12</p>
                                                </div>

                                                <div class="col-3  d-block text-center clock">

                                                   <p class="second">250</p>
                                                </div>

                                             </div>
                                          </div>

                                          <!-- ================================== -->
                                          <div class="score-part mb-3 scroll-page">
                                             <div class="row row-cols-1 row-cols-sm-3">
                                                <div class="col-3">
                                                   <p class="number">
                                                      09
                                                   </p>
                                                </div>
                                                <div class="col-6  d-block text-center clock">

                                                   <p class="second text-center ">01310****12</p>
                                                </div>

                                                <div class="col-3  d-block text-center clock">

                                                   <p class="second">247</p>
                                                </div>

                                             </div>
                                          </div>
                                          <!-- ================================== -->
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
   <!-- Bootstrap core JavaScript
  ================================================== -->
   <!-- Placed at the end of the document so the pages load faster -->
   <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

   <script src="{{asset('assets/dist/owlcarousel/owl.carousel.js')}}"></script>
   <script src="{{asset('assets/dist/scrollreveal/scrollreveal.min.js')}}"></script>
   <script src="{{asset('assets/js/main.js')}}"></script>

   <script>

      const body = document.querySelector('body');
      const button = document.querySelector('#darkbutton');

      const containerFluid = document.querySelector('.container-fluid');
      const footerbody = document.querySelector('.footer-body');
      const topNavbar = document.querySelector('.top-navbar');
      const topmenubg = document.querySelector('.top-menu-bg');
      // const topmenubg = document.querySelector('.top-menu-bg');

      function toggleDark() {

         if (body.classList.contains('bodyDark')) {

            body.classList.remove('bodyDark');
            containerFluid.classList.remove('containerDark');
            topNavbar.classList.remove('topNavbar');
            topmenubg.classList.remove('topmenubg');
            footerbody.classList.remove('footerbody');

            localStorage.setItem("theme", "light");

            button.innerHTML = "<p>Dark Mode<p>";

         } else {

            body.classList.add('bodyDark');
            containerFluid.classList.add('containerDark');
            topNavbar.classList.add('topNavbar');
            topmenubg.classList.add('topmenubg');
            footerbody.classList.add('footerbody');
            localStorage.setItem("theme", "bodyDark");

            button.innerHTML = "<p>Light Mode</p>";

         }

      }

      if (localStorage.getItem("theme") === "bodyDark") {

         body.classList.add('bodyDark');
         containerFluid.classList.add('containerDark');
         topNavbar.classList.add('topNavbar');
         topmenubg.classList.add('topmenubg');
         footerbody.classList.add('footerbody');

         button.innerHTML = "<p>Light Mode</p>";

      }

      document.querySelector('#darkbutton').addEventListener('click', toggleDark);

   </script>



</body>

</html>
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
   <meta charset="utf-8">
   <title>QACA HOUSE</title>
   <meta name="description" content="">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="csrf-token" content="{{ csrf_token() }}">

   <!-- Place favicon.ico in the root directory -->
   <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/logo/favicon.png') }}">

   <!-- CSS here -->
   <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
   <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
   <link rel="stylesheet" href="{{ asset('assets/css/custom-animation.css') }}">
   <link rel="stylesheet" href="{{ asset('assets/css/font-awesome-pro.css') }}">
   <link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.css') }}">
   <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}">
   <link rel="stylesheet" href="{{ asset('assets/css/slick.css') }}">
   
    <!-- Include jQuery (make sure it's loaded first) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Include Select2 CSS (stable version 4.0.13) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

    <!-- Include Select2 JS (stable version 4.0.13) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

   <link rel="stylesheet" href="{{ asset('assets/css/spacing.css') }}">
   <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
   <!-- SweetAlert2 CDN -->
   <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.0/dist/sweetalert2.min.css" rel="stylesheet">
   
</head>


<body>
    <div id="app">
        
        
   <!-- preloader start -->
   <div id="loading">
      <div class="preloader-close">x</div>
      <div id="loading-center">
         <div id="loading-center-absolute">
            <div class="object" id="object_four"></div>
            <div class="object" id="object_three"></div>
            <div class="object" id="object_two"></div>
            <div class="object" id="object_one"></div>
         </div>
      </div>
   </div>
   <!-- preloader start -->

   <!-- back to top start -->
   <div class="back-to-top-wrapper">
      <button id="back_to_top" type="button" class="back-to-top-btn">
         <svg width="12" height="7" viewBox="0 0 12 7" fill="none">
            <path d="M11 6L6 1L1 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
               stroke-linejoin="round" />
         </svg>
      </button>
   </div>
   <!-- back to top end -->

   <!-- search popup start -->
   <div class="search__popup">
      <div class="container">
         <div class="row gx-30">
            <div class="col-xxl-12">
               <div class="search__wrapper">
                  <div class="search__top d-flex justify-content-between align-items-center">
                     <div class="search__logo">
                        
                     </div>
                     <div class="search__close">
                        <button type="button" class="search__close-btn search-close-btn">
                           <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
                              <path d="M17 1L1 17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                 stroke-linejoin="round" />
                              <path d="M1 1L17 17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                 stroke-linejoin="round" />
                           </svg>
                        </button>
                     </div>
                  </div>
                  <div class="search__form">
                     <form action="#">
                        <div class="search__input">
                           <input class="search-input-field" type="text" placeholder="Type here to search...">
                           <span class="search-focus-border"></span>
                           <button type="submit">
                              <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                 <path
                                    d="M9.55 18.1C14.272 18.1 18.1 14.272 18.1 9.55C18.1 4.82797 14.272 1 9.55 1C4.82797 1 1 4.82797 1 9.55C1 14.272 4.82797 18.1 9.55 18.1Z"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                 <path d="M19.0002 19.0002L17.2002 17.2002" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                              </svg>
                           </button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- search popup end -->
   <!-- rr-offcanvus-area-start -->
   <div class="rroffcanvas-area">
      <div class="rroffcanvas">
         <div class="rroffcanvas__close-btn">
            <button class="close-btn"><i class="fal fa-times"></i></button>
         </div>
         <div class="rroffcanvas__logo">
            <a href="{{ url('/') }}">
               <img src="{{ asset('assets/img/logo/logo.png') }}" alt="img" style="max-width:45%;">
            </a>
         </div>
         <div class="rr-main-menu-mobile d-xl-none"></div>
         <div class="rroffcanvas__contact-info">
            <div class="rroffcanvas__contact-title">
               <h5>Contact us</h5>
            </div>
            <ul>
               <li>
                  <i class="fa-light fa-location-dot"></i>
                  <a href="htrrs://www.google.com/maps/@23.8223586,90.3661283,15z" target="_blank">Lot 28167, Ground Floor, Batu 4, Jln Gombak, Kampung Kuantan, 53000 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur</a>
               </li>
               <li>
                  <i class="fas fa-envelope"></i>
                  <a href="mailto:qacahouse@gmail.com">qacahouse@gmail.com</a>
               </li>
               <li>
                  <i class="fal fa-phone-alt"></i>
                  <a href="tel:601126169014">+6011-26169014</a>
               </li>
            </ul>
         </div>
         <div class="rroffcanvas__social">
            <div class="social-icon">
               <a target="_blank" href="https://www.instagram.com/theqacahouse"><i class="fab fa-instagram"></i></a>
               
            </div>
         </div>
      </div>
   </div>
   <div class="body-overlay"></div>
   <!-- rr-offcanvus-area-end -->
   <!-- header top area start -->
   <div class="rr-header-top d-none d-xl-block p-relative">
      <div class="container">
         <div class="rr-header-before">
            <div class="row align-items-center">
               <div class="col-xxl-10 col-xl-10 col-lg-10">
                  <div class="rr-header-top-info text-end">
                     <ul class="d-flex align-items-center">
                        <!--<li>
                           <b><span><i class="fa-regular fa-clock"></i></span> Monday - Friday, 8:00am- 5:00 pm</b>
                        </li>-->
                        <li class="ml-30">
                           <a href="tel:601126169014"><span><img src="{{ asset('assets/img/header/call.svg') }}" alt=""></span>
                              +6011-26169014</a>
                        </li>
                        <li class="ml-30">
                           <a href="http://www.google.com.bd/maps/@3.2091,101.6940,12z"><span><i
                                    class="fa-regular fa-location-dot"></i></span> Lot 28167, Ground Floor, Batu 4, Jln Gombak, Kampung Kuantan, 53000 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur</a>
                        </li>
                     </ul>
                  </div>
               </div>
               <div class="col-xxl-2 col-xl-2 col-lg-">
                  <div class="rr-header-2-top-info d-flex align-items-center justify-content-end text-end">
                     <div class="rr-header-main-social d-flex align-items-center">
                        <div class="rr-header-social ml-20">
                           
                           <!--<a href="#"><svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                 <path
                                    d="M12.2 6.05261C13.4731 6.05261 14.694 6.58494 15.5941 7.53249C16.4943 8.48005 17 9.7652 17 11.1052V17H13.8V11.1052C13.8 10.6586 13.6315 10.2302 13.3314 9.91433C13.0313 9.59848 12.6244 9.42103 12.2 9.42103C11.7757 9.42103 11.3687 9.59848 11.0687 9.91433C10.7686 10.2302 10.6 10.6586 10.6 11.1052V17H7.40002V11.1052C7.40002 9.7652 7.90574 8.48005 8.80591 7.53249C9.70609 6.58494 10.927 6.05261 12.2 6.05261Z"
                                    stroke="#051145" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                 <path d="M4.2 6.89471H1V17H4.2V6.89471Z" stroke="#051145" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                 <path
                                    d="M2.6 4.36842C3.48366 4.36842 4.2 3.61437 4.2 2.68421C4.2 1.75405 3.48366 1 2.6 1C1.71634 1 1 1.75405 1 2.68421C1 3.61437 1.71634 4.36842 2.6 4.36842Z"
                                    stroke="#051145" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                              </svg>
                           </a>-->
						   <a target="_blank" href="https://www.instagram.com/theqacahouse"><svg width="11" height="18" viewBox="0 0 11 18" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                 <path
                                    d="M10 1H7.54545C6.46048 1 5.41994 1.42143 4.65275 2.17157C3.88555 2.92172 3.45455 3.93913 3.45455 5V7.4H1V10.6H3.45455V17H6.72727V10.6H9.18182L10 7.4H6.72727V5C6.72727 4.78783 6.81347 4.58434 6.96691 4.43431C7.12035 4.28429 7.32846 4.2 7.54545 4.2H10V1Z"
                                    stroke="#051145" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                              </svg>
                           </a>
                           <a target="_blank" href="https://www.instagram.com/theqacahouse"><svg width="20" height="18" viewBox="0 0 20 18" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                 <path
                                    d="M19 1.00897C18.2165 1.61128 17.349 2.07195 16.4309 2.37324C15.9382 1.75576 15.2833 1.3181 14.5548 1.11947C13.8264 0.920833 13.0596 0.970799 12.3581 1.26261C11.6565 1.55442 11.0542 2.07399 10.6324 2.75105C10.2107 3.42812 9.98993 4.23001 10 5.04827V5.93995C8.56215 5.98058 7.13741 5.63305 5.85264 4.92829C4.56788 4.22354 3.46299 3.18345 2.63636 1.90065C2.63636 1.90065 -0.636364 9.92575 6.72727 13.4925C5.04225 14.739 3.03495 15.364 1 15.2758C8.36364 19.7342 17.3636 15.2758 17.3636 5.02152C17.3629 4.77315 17.341 4.52539 17.2982 4.28143C18.1332 3.38395 18.7225 2.25082 19 1.00897Z"
                                    stroke="#051145" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                              </svg>
                           </a>
                           <a  target="_blank" href="https://www.instagram.com/theqacahouse"><svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                 <path
                                    d="M13 1H5C2.79086 1 1 2.79086 1 5V13C1 15.2091 2.79086 17 5 17H13C15.2091 17 17 15.2091 17 13V5C17 2.79086 15.2091 1 13 1Z"
                                    stroke="#051145" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                 <path
                                    d="M12.2 8.496C12.2987 9.16179 12.185 9.84177 11.875 10.4392C11.565 11.0366 11.0745 11.5211 10.4733 11.8237C9.87207 12.1263 9.19074 12.2317 8.52621 12.1247C7.86169 12.0178 7.24779 11.7041 6.77186 11.2281C6.29592 10.7522 5.98217 10.1383 5.87524 9.47377C5.76831 8.80924 5.87364 8.12791 6.17625 7.5267C6.47886 6.92548 6.96333 6.43499 7.56077 6.12499C8.15821 5.81499 8.83819 5.70127 9.50399 5.8C10.1831 5.9007 10.8119 6.21717 11.2973 6.70264C11.7828 7.18812 12.0993 7.81686 12.2 8.496Z"
                                    stroke="#051145" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                 <path d="M13.4 4.59998H13.408" stroke="#051145" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                              </svg>
                           </a>
                        </div>
                     </div>
                  </div>
               </div>

            </div>
         </div>
      </div>
   </div>
   <!-- header top area end -->
   <header class="rr-header-main z-index-3">
      <!-- header area start -->
      <div id="header-sticky" class="rr-header-area">
         <div class="container">
            <div class="row align-items-center">
               <div class="col-xl-2 col-lg-5 col-5">
                  <div class="rr-header-logo">
                     <a href="{{ url('/') }}"><img src="{{ asset('assets/img/logo/logo.png') }}" alt="img" style="max-width:45%;"></a>
                  </div>
               </div>
               <div class="col-xl-8 col-lg-1 col-1">
                  <div class="rr-header-main-menu d-none d-xl-block mr-80 p-relative">
                     <nav class="rr-main-menu-content text-end rr-header-1-before">
                        <ul>
                           <li>
                              <a href="{{ url('/') }}">Home</a>
                              
                           </li>
                           <li><a href="{{ route('about') }}">About us</a></li>
                           <li><a href="{{ route('services') }}">Service</a></li>
							<li><a href="#contact-section-link">Contact</a></li>
                           @guest
                           <li >
                                <a  href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li>
                                    <a  href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                           @else
                           <li>
                                    <a  href="{{ route('my-events') }}">My Events</a>
                                </li>
                                
                                 <li class="d-block d-md-none">
                                    <a  href="{{ route('book-appointment') }}">Book Now</a>
                                </li>
                           <li>
                               
                           <a  href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                           </li>
                           @endguest
                        </ul>
                     </nav>
                  </div>
               </div>
               <div class="col-xl-2 col-lg-6 col-6">
                  <div class="rr-header-right d-flex align-items-center justify-content-end p-relative">

                     

                     <div class="rr-header-contat d-none d-md-block ml-35">
                        <a class="rr-btn" href="{{ route('book-appointment') }}"><span>Book Now</span> <i
                              class="fa-sharp fa-solid fa-arrow-right"></i></a>
                     </div>
                     <div class="rr-header-bar d-xl-none">
                        <button class="rr-menu-bar"><i class="fa-solid fa-bars"></i></button>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- header area end -->

   </header>

        <main class="pt-4">
            @yield('content')
        </main>

        
    </div>

    <footer>
      <div class="rr-footer-main p-relative fix">
         <!-- footer area start -->
         <div class="rr-footer-area pt-85 p-relative" data-bg-color="#2A534C" style="background-color:#2A534C;">
            <div class="container">
               <div class="row gx-30">
                  <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 mb-50 wow rrfadeUp" data-wow-duration=".9s"
                     data-wow-delay=".3s">
                     <div class="rr-footer-widget footer-cols-1">
                        <div class="rr-footer-logo pb-20">
                           <a href="{{ url('/') }}"><img src="{{ asset('assets/img/logo/logo.png') }}" alt="img" style="max-width:45%; max-width: 60%;
  padding:10px;"></a>
                        </div>
                        <div class="rr-footer-widget-content mb-25">
                           <p></p>
                        </div>
                        <div class="rr-footer-social d-flex align-items-center">
                           <span>Follow Us :</span>
                           <a  target="_blank" href="https://www.instagram.com/theqacahouse"><svg width="11" height="18" viewBox="0 0 11 18" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                 <path
                                    d="M10 1H7.54545C6.46048 1 5.41994 1.42143 4.65274 2.17157C3.88555 2.92172 3.45455 3.93913 3.45455 5V7.4H1V10.6H3.45455V17H6.72727V10.6H9.18182L10 7.4H6.72727V5C6.72727 4.78783 6.81347 4.58434 6.96691 4.43431C7.12035 4.28429 7.32846 4.2 7.54545 4.2H10V1Z"
                                    stroke="#051145" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                              </svg>
                           </a>
                           <a target="_blank" href="https://www.instagram.com/theqacahouse"><svg width="20" height="18" viewBox="0 0 20 18" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                 <path
                                    d="M19 1.00897C18.2165 1.61128 17.349 2.07195 16.4309 2.37324C15.9382 1.75576 15.2833 1.3181 14.5548 1.11947C13.8264 0.920833 13.0596 0.970799 12.3581 1.26261C11.6565 1.55442 11.0542 2.07399 10.6324 2.75105C10.2107 3.42812 9.98993 4.23001 10 5.04827V5.93995C8.56215 5.98058 7.13741 5.63305 5.85264 4.92829C4.56788 4.22354 3.46299 3.18345 2.63636 1.90065C2.63636 1.90065 -0.636364 9.92575 6.72727 13.4925C5.04225 14.739 3.03495 15.364 1 15.2758C8.36364 19.7342 17.3636 15.2758 17.3636 5.02152C17.3629 4.77315 17.341 4.52539 17.2982 4.28143C18.1332 3.38395 18.7225 2.25082 19 1.00897Z"
                                    stroke="#040404" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                              </svg>
                           </a>
                           <a target="_blank" href="https://www.instagram.com/theqacahouse"><svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                 <path
                                    d="M13 1H5C2.79086 1 1 2.79086 1 5V13C1 15.2091 2.79086 17 5 17H13C15.2091 17 17 15.2091 17 13V5C17 2.79086 15.2091 1 13 1Z"
                                    stroke="#051145" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                 <path
                                    d="M12.2 8.49624C12.2987 9.16204 12.185 9.84201 11.875 10.4395C11.565 11.0369 11.0745 11.5214 10.4733 11.824C9.87204 12.1266 9.19071 12.2319 8.52618 12.125C7.86165 12.0181 7.24776 11.7043 6.77183 11.2284C6.29589 10.7524 5.98214 10.1385 5.87521 9.47401C5.76828 8.80948 5.87361 8.12816 6.17622 7.52694C6.47882 6.92572 6.9633 6.43523 7.56074 6.12523C8.15818 5.81523 8.83816 5.70151 9.50395 5.80024C10.1831 5.90095 10.8118 6.21741 11.2973 6.70289C11.7828 7.18836 12.0992 7.8171 12.2 8.49624Z"
                                    stroke="#051145" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                 <path d="M13.4 4.6001H13.408" stroke="#051145" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                              </svg>
                           </a>
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 mb-50 wow rrfadeUp" data-wow-duration=".9s"
                     data-wow-delay=".5s">
                     <div class="rr-footer-widget footer-cols-2">
                        <h4 class="rr-footer-title">Information</h4>
                        <div class="rr-footer-list ">
                           <ul>
                              <li><a href="{{ route('about') }}">About Us</a></li>
                             
                              <li><a href="{{ route('services') }}">Service</a></li>
                           </ul>
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 mb-50 wow rrfadeUp" data-wow-duration=".9s"
                     data-wow-delay=".3s">
                     <div class="rr-footer-widget footer-cols-1 contact-section">
                        <h4 class="rr-footer-title">Contact</h4>
                        <div class="rr-footer-widget-content mb-25">
                           <p>Would you have any enquiries.Please feel free to contuct us</p>
                           <div class="rr-footer-widget-content-item">
                              <svg width="16" height="13" viewBox="0 0 16 13" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                 <path
                                    d="M2.4 1H13.6C14.37 1 15 1.63 15 2.4V10.8C15 11.57 14.37 12.2 13.6 12.2H2.4C1.63 12.2 1 11.57 1 10.8V2.4C1 1.63 1.63 1 2.4 1Z"
                                    stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                 <path d="M15 2.3999L8 7.2999L1 2.3999" stroke="white" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                              </svg>
                              <a href="mailto:qacahouse@gmail.com">qacahouse@gmail.com</a>
                           </div>
                           <div class="rr-footer-widget-content-item">
                              <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                 <path
                                    d="M9.67161 3.67583C10.3263 3.80331 10.9279 4.12286 11.3995 4.59359C11.8712 5.06432 12.1913 5.66481 12.319 6.3182M9.67161 1C11.0317 1.15081 12.3 1.75871 13.2683 2.72391C14.2365 3.6891 14.8472 4.95421 15 6.31151M14.3298 11.6498V13.6567C14.3305 13.843 14.2923 14.0274 14.2175 14.1981C14.1427 14.3688 14.033 14.522 13.8955 14.648C13.758 14.7739 13.5956 14.8698 13.4187 14.9295C13.2419 14.9892 13.0546 15.0113 12.8686 14.9946C10.8062 14.7709 8.8251 14.0675 7.08449 12.9409C5.46509 11.9138 4.09211 10.5434 3.06307 8.92713C1.93035 7.18196 1.22544 5.19502 1.00544 3.12728C0.988691 2.94229 1.01072 2.75585 1.07012 2.57982C1.12952 2.4038 1.22499 2.24204 1.35046 2.10486C1.47592 1.96768 1.62863 1.85808 1.79886 1.78303C1.96909 1.70798 2.15312 1.66913 2.33921 1.66896H4.34993C4.6752 1.66576 4.99053 1.78072 5.23716 1.99242C5.48379 2.20411 5.64488 2.49809 5.6904 2.81956C5.77527 3.4618 5.93266 4.0924 6.15957 4.69933C6.24974 4.93876 6.26926 5.19898 6.2158 5.44915C6.16235 5.69932 6.03816 5.92895 5.85796 6.11083L5.00676 6.9604C5.96088 8.63517 7.35021 10.0218 9.02818 10.9741L9.87939 10.1246C10.0616 9.94471 10.2917 9.82076 10.5423 9.76741C10.793 9.71405 11.0537 9.73353 11.2936 9.82354C11.9017 10.05 12.5335 10.2071 13.177 10.2918C13.5025 10.3376 13.7999 10.5013 14.0124 10.7517C14.225 11.0021 14.3379 11.3217 14.3298 11.6498Z"
                                    stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                              </svg>
                              <a href="tel:601126169014">+6011-26169014</a>
                           </div>
                           <div class="rr-footer-widget-content-item">
                              <svg width="16" height="15" viewBox="0 0 16 15" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                 <path d="M1 3.6V14L5.45455 11.4L10.5455 14L15 11.4V1L10.5455 3.6L5.45455 1L1 3.6Z"
                                    stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                 <path d="M5.45453 1V11.4" stroke="white" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                 <path d="M10.5455 3.6001V14.0001" stroke="white" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                              </svg>
                              <a href="#"> Lot 28167, Ground Floor, Batu 4, Jln Gombak, Kampung Kuantan, 53000 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur</a>
                           </div>

                        </div>
                     </div>
                  </div>
                  <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 mb-50 wow rrfadeUp" data-wow-duration=".9s"
                     data-wow-delay=".7s">
                     <div class="rr-footer-widget footer-cols-3">
                        <h4 class="rr-footer-title">Gallery</h4>
                        <div class="rr-footer__widget-gallery-wrap">
                           <div class="row gx-5">
                              <div class="col-xl-4 col-lg-4 col-md-3 col-4  p-1">
                                 <div class="rr-footer__widget-gallery p-relative">
                                    <a href="{{ asset('assets/img/gallery/4.jpg') }}" class="our-gallery__item popup-image">
                                       <img src="{{ asset('assets/img/gallery/4.jpg') }}" alt="image not found" style="width: 100px;height: 90px;">
                                       <span><i class="fa-solid fa-plus"></i></span>
                                    </a>
                                 </div>
                              </div>
                              <div class="col-xl-4 col-lg-4 col-md-3 col-4  p-1">
                                 <div class="rr-footer__widget-gallery p-relative">
                                    <a href="{{ asset('assets/img/gallery/1.jpg') }}" class="our-gallery__item popup-image">
                                       <img src="{{ asset('assets/img/gallery/1.jpg') }}" alt="image not found" style="width: 100px;height: 90px;">
                                       <span><i class="fa-solid fa-plus"></i></span>
                                    </a>
                                 </div>
                              </div>
                              <div class="col-xl-4 col-lg-4 col-md-3 col-4  p-1">
                                 <div class="rr-footer__widget-gallery p-relative">
                                    <a href="{{ asset('assets/img/gallery/2.jpg') }}" class="our-gallery__item popup-image">
                                       <img src="{{ asset('assets/img/gallery/2.jpg') }}" alt="image not found" style="width: 100px;height: 90px;">
                                       <span><i class="fa-solid fa-plus"></i></span>
                                    </a>
                                 </div>
                              </div>
                              <div class="col-xl-4 col-lg-4 col-md-3 col-4  p-1">
                                 <div class="rr-footer__widget-gallery p-relative">
                                    <a href="{{ asset('assets/img/gallery/3.jpg') }}" class="our-gallery__item popup-image">
                                       <img src="{{ asset('assets/img/gallery/3.jpg') }}" alt="image not found" style="width: 100px;height: 90px;">
                                       <span><i class="fa-solid fa-plus"></i></span>
                                    </a>
                                 </div>
                              </div>
                              <div class="col-xl-4 col-lg-4 col-md-3 col-4  p-1">
                                 <div class="rr-footer__widget-gallery p-relative">
                                    <a href="{{ asset('assets/img/gallery/5.jpg') }}" class="our-gallery__item popup-image">
                                       <img src="{{ asset('assets/img/gallery/5.jpg') }}" alt="image not found" style="width: 100px;height: 90px;">
                                       <span><i class="fa-solid fa-plus"></i></span>
                                    </a>
                                 </div>
                              </div>
                              <div class="col-xl-4 col-lg-4 col-md-3 col-4  p-1">
                                 <div class="rr-footer__widget-gallery p-relative">
                                    <a href="{{ asset('assets/img/gallery/6.jpg') }}" class="our-gallery__item popup-image">
                                       <img src="{{ asset('assets/img/gallery/6.jpg') }}" alt="image not found" style="width: 100px;height: 90px;"><span><i
                                             class="fa-solid fa-plus"></i></span>
                                    </a>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- footer area end -->

         <!-- copy-right area start -->
         <div class="rr-copyright-area p-relative" data-bg-color="#2A534C" style="background-color:#2A534C;">
            <div class="container rr-copyright-space">
               <div class="row align-items-center">
                  <div class="col-xl-12 wow rrfadeUp" data-wow-duration=".9s" data-wow-delay=".3s">
                     <div class="rr-copyright-left text-center">
                        <p>© 2025 TheQacaHouse. All Rights Reserved.</p>

                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- copy-right area end -->
      </div>
   </footer>

       
<script>
    var $jq = jQuery.noConflict();
    $jq(document).ready(function() {
    $jq('#special_requests').select2();
    });
</script>

   <!-- JS here -->
   <script src="{{ asset('assets/js/vendor/jquery.js') }}"></script>
   <script src="{{ asset('assets/js/vendor/waypoints.js') }}"></script>
   <script src="{{ asset('assets/js/bootstrap-bundle.js') }}"></script>
   <script src="{{ asset('assets/js/swiper-bundle.js') }}"></script>
   <script src="{{ asset('assets/js/slick.js') }}"></script>
   <script src="{{ asset('assets/js/magnific-popup.js') }}"></script>
   
   <script src="{{ asset('assets/js/purecounter.js') }}"></script>
   <script src="{{ asset('assets/js/wow.js') }}"></script>
   <script src="{{ asset('assets/js/smooth-scroll.js') }}"></script>
   <script src="{{ asset('assets/js/ajax-form.js') }}"></script>
   <script src="{{ asset('assets/js/imagesloaded-pkgd.js') }}"></script>
   <script src="{{ asset('assets/js/main.js') }}"></script>
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.0/dist/sweetalert2.all.min.js"></script>
   @yield('scripts')
   

   <!--Start of Tawk.to Script-->
<script type="text/javascript">
   

      document.querySelector('a[href="#contact-section-link"]')?.addEventListener('click', function (e) {
      e.preventDefault(); // Prevent default jump
      const contactSection = document.querySelector('#contact-section');
      if (contactSection) {
         contactSection.scrollIntoView({ behavior: 'smooth' });
      }
   });

  /* var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
   (function(){
   var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
   s1.async=true;
   s1.src='https://embed.tawk.to/67826d9eaf5bfec1dbea2b05/1ihanodas';
   s1.charset='UTF-8';
   s1.setAttribute('crossorigin','*');
   s0.parentNode.insertBefore(s1,s0);
   })();*/
</script>
   <!--End of Tawk.to Script-->

</body>

</html>




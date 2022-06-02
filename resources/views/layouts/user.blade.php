<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="../shine/assets/img/Logo.png" type="image/png">

    <link rel="stylesheet" href="{!! asset('css/app.css') !!}">

    <title>Garden Petshop</title>

    <!-- Icon -->
    <link rel="stylesheet" type="text/css" href="../shine/assets/css/LineIcons.2.0.css">
    <!-- Animate -->
    <link rel="stylesheet" type="text/css" href="../shine/assets/css/animate.css">
    <!-- Tiny Slider  -->
    <link rel="stylesheet" type="text/css" href="../shine/assets/css/tiny-slider.css">
    <!-- Tailwind css -->
    <link rel="stylesheet" type="text/css" href="../shine/assets/css/tailwind.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    @yield('style')
    @livewireStyles

    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src="../shine/assets/js/wow.js"></script>
    <script src="../shine/assets/js/tiny-slider.js"></script>
    <script src="../shine/assets/js/contact-form.js"></script>
    <script src="../shine/assets/js/main.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/flatpickr.min.js"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/id.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    @yield('scripts')
    @livewireScripts
  </head>
  
  <body>
    <div class="bg-blue-100">
        @yield('content')
    </div>
    
    <!-- Header Area wrapper End -->
    	  <!-- Footer Section Start -->
          <footer id="footer" class="bg-gray-800 py-16">
            <div class="container">
              <div class="flex flex-wrap">
                <div class="w-full sm:w-1/2 md:w-1/2 lg:w-1/4 wow fadeInUp" data-wow-delay="0.2s">
                  <div class="mx-3 mb-8">
                    <div class="footer-logo mb-3 inline">
                      <img src="../shine/assets/img/Logo.png" alt="" style="width: 150px; height:50px">
                      <span class="font-mono font-semibold text-blue-500 ml-4">GARDEN PETSHOP</span></a>
                    </div>
                    <p class="text-gray-300">Bersama Kami Selalu Menyanyangi.</p>
                    </div>
                </div>
                <div class="w-full sm:w-1/2 md:w-1/2 lg:w-1/4 wow fadeInUp" data-wow-delay="0.4s">
                  <div class="mx-3 mb-8">
                    <h3 class="font-bold text-xl text-white mb-5">Jam buka</h3>
                    <ul>
                      <li><a href="#" class="footer-links">Senin-Jumat</a></li><span>08.00- 20.00</span>
                      <li><a href="#" class="footer-links">Sabtu-Minggu</a></li><span>09.00 - 20.30</span>
                    </ul>
                  </div>
                </div>
                <div class="w-full sm:w-1/2 md:w-1/2 lg:w-1/4 wow fadeInUp" data-wow-delay="0.6s">
                  <div class="mx-3 mb-8">
                    <h3 class="font-bold text-xl text-white mb-5">About</h3>
                    <ul>
                      <li><a href="#" class="footer-links">Career</a></li>
                      <li><a href="#" class="footer-links">Team</a></li>
                    </ul>
                  </div>
                </div>
                <div class="w-full sm:w-1/2 md:w-1/2 lg:w-1/4 wow fadeInUp" data-wow-delay="0.8s">
                  <div class="mx-3 mb-8">
                    <h3 class="font-bold text-xl text-white mb-5">Find us on</h3>

                    <ul class="social-icons flex justify-start">
                      <li class="mx-2">
                        <a href="#"
                          class="footer-icon hover:bg-indigo-500">
                          <i class="lni lni-facebook-original" aria-hidden="true"></i>
                        </a>
                      </li>
                      <li class="mx-2">
                        <a href="#"
                          class="footer-icon hover:bg-red-500">
                          <i class="lni lni-instagram-original" aria-hidden="true"></i>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </footer>
          <!-- Footer Section End -->

          <section class="bg-gray-800 py-6 border-t-2 border-gray-700 border-dotted">
            <div class="container">
              <div class="flex flex-wrap">
                <div class="w-full text-center">
                  <p class="text-white">Designed and Developed by <a class="text-white duration-300 hover:text-blue-600" href="https://graygrids.com" rel="nofollow">TailwindTemplates</a> and <a class="text-white duration-300 hover:text-blue-600" href="https://uideck.com" rel="nofollow">UIdeck</a></p>
                </div>
              </div>
            </div>
          </section>

          <!-- Go to Top Link -->
          <a href="#" class="back-to-top w-10 h-10 fixed bottom-0 right-0 mb-5 mr-5 flex items-center justify-center rounded-full bg-blue-600 text-white text-lg z-20 duration-300 hover:bg-blue-400">
            <i class="lni lni-arrow-up"></i>
          </a>
        </body>
</html>
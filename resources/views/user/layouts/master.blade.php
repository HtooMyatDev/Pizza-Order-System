<!DOCTYPE html>

<html lang="en">

<head>
    @include('sweetalert::alert')
    <title>Pizza Frenzy</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nothing+You+Could+Do" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('user/css/customize.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/open-iconic-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/jquery.timepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/icomoon.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/bootstrap.min.css') }}">

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-black ftco-navbar-light" id="ftco-navbar">
        <div class="container">
            <a class="navbar-brand" href="index.html"><span
                    class="flaticon-pizza-1 mr-1"></span>Pizza<br><small>Frenzy</small></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
                aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
            </button>
            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto d-flex justify-content-center align-items-center">
                    <li class="nav-item @if (Request::route()->getName() == 'user#home') active @endif"><a
                            href="{{ route('user#home') }}" class="nav-link">Home</a></li>
                    <li class="nav-item @if (Request::route()->getName() == 'user#menu') active @endif"><a
                            href="{{ route('user#menu') }}" class="nav-link">Menu</a></li>
                    <li class="nav-item @if (Request::route()->getName() == 'user#service') active @endif"><a
                            href="{{ route('user#service') }}" class="nav-link">Services</a></li>
                    {{-- <li class="nav-item @if (Request::route()->getName() == 'user#blog') active @endif"><a
                            href="{{ route('user#blog') }}" class="nav-link">Blog</a></li> --}}
                    {{-- <li class="nav-item @if (Request::route()->getName() == 'user#about') active @endif"><a
                            href="{{ route('user#about') }}" class="nav-link">About</a></li>--}}
                    <li class="nav-item @if (Request::route()->getName() == 'user#contact') active @endif"><a
                            href="{{ route('user#contact') }}" class="nav-link">Contact</a></li>
                    <li class="nav-item @if (Request::route()->getName() == 'user#order#list') active @endif"><a
                            href="{{ route('user#order#list') }}" class="nav-link">Orders</a></li>
                    <li class="nav-item @if (Request::route()->getName() == 'user#cart') active @endif">
                        <a href="{{ route('user#cart') }}" class="nav-link">

                            <button type="button" class="btn btn-sm btn-outline-warning position-relative">
                                <i class="fa-solid fa-cart-shopping"></i>
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill fw-bold bg-danger" >
                                    {{ count($carts) }}+
                                </span>
                            </button>
                        </a>
                    </li>

                    <li class="nav-item">
                        <img src="{{ asset(Auth::user()->profile ? 'profile/' . Auth::user()->profile : 'profile/default.jpeg') }}"
                            class="img-thumbnail ml-2"
                            style="border-radius: 50%; width:40px; height:40px; object-fit:cover;">
                    </li>
                    <li class="nav-item">
                        <span class="text-warning fw-bold ml-2">{{ Auth::user()->name }}</span>
                    </li>
                    <li class="nav-item">
                        <!-- Split dropup button -->
                        <div class="btn-group ml-2">
                            <a class="dropdown-toggle dropdown-toggle-split text-warning " data-bs-toggle="dropdown"
                                aria-expanded="false">
                            </a>
                            <ul class="dropdown-menu bg-warning">
                                <li>
                                    <a class="dropdown-item" href="{{ route('user#profile') }}">Profile</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">Settings</a>
                                </li>
                                <li class="text-center justify-content-center mt-2">
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button class="dropdown-item text-center align-items-center">
                                            Logout
                                            <i class="fa-solid fa-right-from-bracket ml-1"></i>
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>


            </div>
        </div>
    </nav>
    <!-- END nav -->

    @yield('content')

    <footer class="ftco-footer ftco-section img">
        <div class="overlay"></div>
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-3 col-md-6 mb-5 mb-md-5">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">About Us</h2>
                        <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia,
                            there live the blind texts.</p>
                        <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                            <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                            <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                            <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-5 mb-md-5">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">Recent Blog</h2>
                        <div class="block-21 mb-4 d-flex">
                            <a class="blog-img mr-4" style="background-image: url(images/image_1.jpg);"></a>
                            <div class="text">
                                <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control
                                        about</a></h3>
                                <div class="meta">
                                    <div><a href="#"><span class="icon-calendar"></span> Sept 15, 2018</a></div>
                                    <div><a href="#"><span class="icon-person"></span> Admin</a></div>
                                    <div><a href="#"><span class="icon-chat"></span> 19</a></div>
                                </div>
                            </div>
                        </div>
                        <div class="block-21 mb-4 d-flex">
                            <a class="blog-img mr-4" style="background-image: url(images/image_2.jpg);"></a>
                            <div class="text">
                                <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control
                                        about</a></h3>
                                <div class="meta">
                                    <div><a href="#"><span class="icon-calendar"></span> Sept 15, 2018</a></div>
                                    <div><a href="#"><span class="icon-person"></span> Admin</a></div>
                                    <div><a href="#"><span class="icon-chat"></span> 19</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 mb-5 mb-md-5">
                    <div class="ftco-footer-widget mb-4 ml-md-4">
                        <h2 class="ftco-heading-2">Services</h2>
                        <ul class="list-unstyled">
                            <li><a href="#" class="py-2 d-block">Cooked</a></li>
                            <li><a href="#" class="py-2 d-block">Deliver</a></li>
                            <li><a href="#" class="py-2 d-block">Quality Foods</a></li>
                            <li><a href="#" class="py-2 d-block">Mixed</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-5 mb-md-5">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">Have a Questions?</h2>
                        <div class="block-23 mb-3">
                            <ul>
                                <li><span class="icon icon-map-marker"></span><span class="text"> Bay90 North 22th
                                        Street, Jao 721 MyoeMa 112211</span></li>
                                <li><a href="#"><span class="icon icon-phone"></span><span class="text">+959
                                            01193313</span></a></li>
                                <li><a href="#"><span class="icon icon-envelope"></span><span
                                            class="text">PizzaFrenzy@gmail.com</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">

                    <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;
                        <script>
                            document.write(new Date().getFullYear());
                        </script> All rights reserved | This template is made with <i class="icon-heart"
                            aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </p>
                </div>
            </div>
        </div>
    </footer>
    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4"
                stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4"
                stroke-miterlimit="10" stroke="#F96D00" />
        </svg></div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('user/js/jquery-migrate-3.0.1.min.js') }}"></script>
    <script src="{{ asset('user/js/popper.min.js') }}"></script>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <script src="{{ asset('user/js/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('user/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('user/js/jquery.stellar.min.js') }}"></script>
    <script src="{{ asset('user/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('user/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('user/js/aos.js') }}"></script>
    <script src="{{ asset('user/js/jquery.animateNumber.min.js') }}"></script>
    <script src="{{ asset('user/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('user/js/jquery.timepicker.min.js') }}"></script>
    <script src="{{ asset('user/js/scrollax.min.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
    <script src="{{ asset('user/js/google-map.js') }}"></script>
    <script src="{{ asset('user/js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    @yield('jQuery')
    <script>
        function loadFile(event) {
            var reader = new FileReader();

            reader.onload = function() {
                var output = document.getElementById('output')
                output.src = reader.result
            }

            reader.readAsDataURL(event.target.files[0])
        }
        $(document).ready(function() {

            var qty = parseInt($('#quantity').val())

            $('.btn-plus').click(function() {
                $('#quantity').val(qty += 1)
                toggleClass()
            })

            $('.btn-minus').click(function() {
                if (qty > 0) {
                    $('#quantity').val(qty -= 1)
                } else {
                    qty = 0
                }
                toggleClass()
            })

            function toggleClass() {
                if ($('#quantity').val() == 0) {
                    $('#addToCart').removeClass('d-inline')
                    $('#addToCart').addClass('d-none')

                    $('#backToMenu').addClass('d-inline')
                } else {
                    $('#addToCart').removeClass('d-none')
                    $('#addToCart').addClass('d-inline')

                    $('#backToMenu').removeClass('d-inline')
                    $('#backToMenu').addClass('d-none')
                }
            }
        })
    </script>
    @include('sweetalert::alert')
</body>

</html>

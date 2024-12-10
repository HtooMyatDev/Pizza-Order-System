<!DOCTYPE html>
<html lang="en">

<head>
    @include('sweetalert::alert')
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Pizza Frenzy Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="{{ asset('admin/css/styles.css') }}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Messages from Customers</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            @if (count($messages) > 0)
                <div>
                    @foreach ($messages as $message)
                        <div class="card shadow-sm">
                            <div class="card-header bg-primary"></div>
                            <div class="card-body">
                                <div class="h6">
                                    <img src="{{ asset($message->profile ? 'profile/' . $message->profile : 'profile/default.jpeg') }}"
                                        class="rounded me-2" style="width:30px;height:30px;object-fit:cover;">
                                    <span class="text-primary">
                                        {{ $message->name }}
                                    </span>
                                </div>
                                <p class="mt-1"> <span class="fw-bold">{{ $message->title }} :
                                    </span>{{ $message->message }}</p>
                                <span class="text-secondary" style="margin-left:135px;">
                                    {{ $message->created_at->format('j F, Y H:m A') }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-danger ">
                    Noone hasn't sent a message yet!
                </div>
            @endif
        </div>
    </div>
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-primary">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3 fw-bold" href="{{ route('admin#home') }}">Pizza Frenzy Admin</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0 text-warning" id="sidebarToggle"
            href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
            </div>
        </form>

        <button type="button" class="btn btn-primary position-relative me-3 mt-2" data-bs-toggle="offcanvas"
            data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
            <i class="fa-solid fa-envelope"></i>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                {{ count($messages) }}+
                <span class="visually-hidden">unread messages</span>
            </span>
        </button>
        <!-- Navbar-->

        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4 ">

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ asset(Auth::user()->profile == null ? 'admin/img/default.jpg' : 'profile/' . Auth::user()->profile) }}"
                        class="object-fit-cover rounded-circle img-fluid img-thumbnail"
                        style="height: 35px; width:35px;">
                    <span class="fw-bold text-white mx-1">{{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="{{ route('admin#profile') }}">Profile</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="dropdown-item">Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="{{ route('admin#home') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-house"></i></div> Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Lists</div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#collapseAdmin" aria-expanded="false" aria-controls="collapseAdmin">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-person-military-pointing"></i></div>
                            Admin Interface
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseAdmin" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('admin#list') }}">
                                    <div class="sb-nav-link-icon"><i class="fa-solid fa-user-group"></i></div>Admin
                                    List
                                </a>
                                @if (Auth::user()->role == 'superadmin')
                                    <a class="nav-link" href="{{ route('admin#add#accountPage') }}">
                                        <div class="sb-nav-link-icon"><i class="fa-solid fa-user-plus"></i></div>Add
                                        New
                                        Admin
                                    </a>
                                @endif
                            </nav>
                        </div>

                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#collapseUser" aria-expanded="false" aria-controls="collapseUser">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-user-shield"></i></div>
                            User Interface
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseUser" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('admin#user#list') }}">
                                    <div class="sb-nav-link-icon"><i class="fa-solid fa-user-group"></i></div>Customer
                                    List
                                </a>
                            </nav>
                        </div>
                        @if (Auth::user()->role == 'superadmin')
                            <a class="nav-link" href="{{ route('admin#payment') }}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-wallet"></i></div> Payment Methods
                            </a>
                        @endif
                        <a class="nav-link" href="{{ route('admin#toppings') }}">
                            <div class="sb-nav-link-icon"><i class="fa-brands fa-delicious"></i></div> Toppings
                        </a>

                        <a class="nav-link" href="{{ route('admin#categories') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-layer-group"></i></div> Pizza Category
                        </a>

                        <a class="nav-link" href="{{ route('admin#pizzas') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-pizza-slice"></i></div> Pizza List
                        </a>

                        <a class="nav-link" href="{{ route('admin#order#list') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-database"></i></div> Order List
                        </a>

                        <a class="nav-link" href="{{ route('admin#order#success') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-square-poll-vertical"></i></div> Sales Info
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    {{ Auth::user()->name }}
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            @yield('content')
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2023</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <button type="button" class="btn btn-primary" id="liveToastBtn">Show live toast</button>

    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <img src="..." class="rounded me-2" alt="...">
                <strong class="me-auto">Bootstrap</strong>
                <small>11 mins ago</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Hello, world! This is a toast message.
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="{{ asset('admin/js/scripts.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('admin/assets/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('admin/assets/demo/chart-bar-demo.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="{{ asset('admin/js/datatables-simple-demo.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        function loadFile(event) {
            var reader = new FileReader();

            reader.onload = function() {
                var output = document.getElementById('output')
                output.src = reader.result
            }

            reader.readAsDataURL(event.target.files[0])
        }
    </script>
    @include('sweetalert::alert')

</body>
@yield('jQuery')

</html>

@extends('user.layouts.master')

@section('content')
    <section class="home-slider owl-carousel img" style="background-image: url({{ asset('user/images/bg_1.jpg') }});">
        <div class="slider-item" style="background-image: url({{ asset('user/images/bg_1.jpg') }});">
            <div class="overlay"></div>
            <div class="container">
                <div class="row mt-3 slider-text justify-content-center align-items-center">
                    <div class="col-md-7 col-sm-12 text-center ftco-animate">
                        <h1 class="mb-3 mt-5 bread">Profile</h1>
                        <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('user#home') }}">Home</a></span>
                            <span>Profile</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section style="margin:100px 0px 100px 0px;">
        <div class="row mt-3">
            <div class="col-8 offset-2">
                <div class="card shadow-sm text-bg-dark mb-3">
                    <div class="card-header bg-warning rounded">
                    </div>
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src=" {{ asset(Auth::user()->profile ? 'profile/' . Auth::user()->profile : 'profile/default.jpeg') }}"
                                class="img-fluid w-100">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <div class="row mt-3 mb-3">
                                    <div class="col">
                                        <h5 class="card-title fw-bold">Username</h5>
                                        <p class="card-text fw-bold text-warning">{{ Auth::user()->name }}
                                            <span>
                                                @if (Auth::user()->nickname)
                                                    ( {{ Auth::user()->nickname }} )
                                                @endif
                                            </span>
                                        </p>

                                    </div>
                                    <div class="col">
                                        <h5 class="card-title fw-bold">Email</h5>
                                        <p class="card-text fw-bold text-warning">{{ Auth::user()->email }}</p>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col">
                                        <h5 class="card-title fw-bold">Phone</h5>
                                        @if (Auth::user()->phone)
                                            <p class="card-text fw-bold text-warning">{{ Auth::user()->phone }}</p>
                                        @else
                                            <p class="bg-danger fw-bold w-75 text-center p-2 rounded">Please Update Your
                                                Information!
                                            </p>
                                        @endif

                                    </div>
                                    <div class="col">
                                        <h5 class="card-title fw-bold">Address</h5>
                                        @if (Auth::user()->address)
                                            <p class="card-text fw-bold text-warning">{{ Auth::user()->address }}</p>
                                        @else
                                            <p class="bg-danger fw-bold w-75 text-center p-2 rounded">Please Update Your
                                                Information!
                                            </p>
                                        @endif

                                    </div>
                                </div>

                                <div class="row mt-5 px-3">
                                    <a href="{{ route('user#profile#edit') }}"
                                        class="btn btn-outline-warning w-100 rounded fw-bold">Edit Your Profile</a>
                                </div>
                                <div class="row mt-3 px-3">
                                    <a href="{{ route('user#profile#changePasswordPage') }}"
                                        class="btn btn-outline-warning w-100 rounded fw-bold">Change Password</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

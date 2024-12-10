@extends('user.layouts.master')

@section('content')
    <section class="home-slider owl-carousel img" style="background-image: url({{ asset('user/images/bg_1.jpg') }});">
        <div class="slider-item" style="background-image: url({{ asset('user/images/bg_1.jpg') }});">
            <div class="overlay"></div>
            <div class="container">
                <div class="row slider-text justify-content-center align-items-center">
                    <div class="col-md-7 col-sm-12 text-center ftco-animate">
                        <h1 class="mb-3 mt-5 bread">Change Password</h1>
                        <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('user#home') }}">Home</a></span>
                            <span>Password</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section style="margin:100px 0px 100px 0px;">

        <div class="row">
            <div class="col-4 offset-4">
                <form action="{{ route('user#profile#changePassword') }}" method="post">
                    @csrf
                    <div class="card bg-dark">
                        <div class="card-header bg-warning"></div>
                        <div class="card-body">
                            @if (Auth::user()->password != null)
                                <div class="row mt-3">
                                    <div class="col  @if (Auth::user()->password == null) text-secondary @endif">
                                        <h5 class="fw-bold text-warning">Current Password</h5>
                                        <input type="password" class="form-control" placeholder="Current Password..."
                                            name="currentPassword">
                                        @error('currentPassword')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                            <div class="row mt-3">
                                <div class="col">
                                    <h5 class="fw-bold text-warning">New Password</h5>
                                    <input type="password" class="form-control" placeholder="New Password..."
                                        name="newPassword">
                                    @error('newPassword')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col">
                                    <h5 class="fw-bold text-warning">Confirm Password</h5>
                                    <input type="password" class="form-control" placeholder="Confirm Password..."
                                        name="confirmPassword">
                                    @error('confirmPassword')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-3 justify-content-center mx-1">
                                <div class="col">
                                    <a href="{{ route('user#profile') }}"
                                        class="btn btn-outline-warning w-100 rounded fw-bold">Back
                                        to Profile</a>
                                </div>
                                <div class="col"> <button class="btn btn-outline-warning w-100 rounded fw-bold">Change
                                        Password</button></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

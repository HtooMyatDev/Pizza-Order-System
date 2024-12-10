@extends('user.layouts.master')

@section('content')
    <section class="home-slider owl-carousel img" style="background-image: url({{ asset('user/images/bg_1.jpg') }});">
        <div class="slider-item" style="background-image: url({{ asset('user/images/bg_1.jpg') }});">
            <div class="overlay"></div>
            <div class="container">
                <div class="row slider-text justify-content-center align-items-center">
                    <div class="col-md-7 col-sm-12 text-center ftco-animate">
                        <h1 class="mb-3 mt-5 bread">Edit Profile</h1>
                        <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('user#home') }}">Home</a></span>
                            <span>Profile</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section style="margin:100px 0px 100px 0px;">

        <form action="{{ route('user#profile#edit') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-8 offset-2">
                    <div class="card shadow-sm text-bg-dark mb-3">
                        <div class="card-header rounded bg-warning">
                        </div>
                        <div class="row g-0">
                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <img src=" {{ asset(Auth::user()->profile ? 'profile/' . Auth::user()->profile : 'profile/default.jpeg') }}"
                                        class="img-fluid w-100" id='output'>
                                    <input type="file"
                                        class="form-control @error('profile')
                                        is-invalid
                                    @enderror p-4"
                                        id="inputGroupFile01" onchange="loadFile(event)" name="profile">
                                </div>
                                @error('profile')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror

                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col">
                                            <h6 class="card-title text-warning fw-bold">Username</h6>
                                            <div class="input-group flex-nowrap">
                                                <input type="text"
                                                    class="form-control @error('name')
                                                    is-invalid
                                                @enderror"
                                                    name="name" placeholder="Username" aria-label="Username"
                                                    aria-describedby="addon-wrapping"
                                                    value="{{ old('name', Auth::user()->name) }}">
                                            </div>
                                            @error('name')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col">
                                            <h6 class="card-title text-warning fw-bold">Email address</h6>
                                            <div class="input-group flex-nowrap">
                                                <input type="text"
                                                    class="form-control @error('email')
                                                    is-invalid
                                                @enderror"
                                                    name="email" placeholder="Email address" aria-label="Username"
                                                    aria-describedby="addon-wrapping"
                                                    value="{{ old('email', Auth::user()->email) }}">
                                            </div>
                                            @error('email')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <h6 class="card-title text-warning fw-bold">Phone</h6>
                                            <div class="input-group flex-nowrap">
                                                <input type="phone"
                                                    class="form-control @error('phone')
                                                    is-invalid
                                                @enderror"
                                                    name="phone" placeholder="Phone number" aria-label="Username"
                                                    aria-describedby="addon-wrapping"
                                                    value="{{ old('phone', Auth::user()->phone) }}">
                                            </div>
                                            @error('phone')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col">
                                            <h6 class="card-title text-warning fw-bold">Address</h6>
                                            <div class="input-group flex-nowrap">
                                                <textarea class="form-control @error('address')
                                                is-invalid
                                                @enderror"
                                                    placeholder="Address" id="exampleFormControlTextarea1" name="address" rows="3">{{ old('address', Auth::user()->address) }}</textarea>
                                            </div>
                                            @error('address')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror

                                        </div>
                                    </div>

                                    <div class="row mt-5 px-3">
                                        <button class="btn btn-outline-warning w-100 rounded fw-bold">Update Your Profile</button>
                                    </div>
                                    <div class="row mt-3 px-3">
                                        <a href="{{ route('user#profile') }}"
                                            class="btn btn-outline-warning w-100 rounded fw-bold">Back to Profile</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
@endsection

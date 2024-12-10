@extends('user.layouts.master')

@section('content')
    <section class="home-slider owl-carousel img" style="background-image: url({{ asset('user/images/bg_1.jpg') }});">

        <div class="slider-item" style="background-image: url({{ asset('user/images/bg_3.jpg') }});">
            <div class="overlay"></div>
            <div class="container">
                <div class="row slider-text justify-content-center align-items-center">

                    <div class="col-md-7 col-sm-12 text-center ftco-animate">
                        <h1 class="mb-3 mt-5 bread">Contact Us</h1>
                        <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Contact</span>
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section contact-section">
        <div class="container mt-5">
            <div class="row block-9">
                <div class="col-md-4 contact-info ftco-animate">
                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <h2 class="h4 text-white">Contact Information</h2>
                        </div>
                        <div class="col-md-12 mb-3">
                            <p class="text-white"><span>Address:</span> Bay90 North 22th Street, Jao 721 MyoeMa 112211</p>
                        </div>
                        <div class="col-md-12 mb-3">
                            <p><span>Phone:</span> <a href="tel://1234567920" class="text-warning">+959 01193313</a></p>
                        </div>
                        <div class="col-md-12 mb-3">
                            <p><span>Email:</span> <a href="mailto:info@yoursite.com"
                                    class="text-warning">pizzaFrenzy@gmail.com</a></p>
                        </div>
                        <div class="col-md-12 mb-3">
                            <p class=""><span>Website:</span> <a class="text-warning" href="{{ route('user#home') }}"
                                    class="text-warning">Pizza Frenzy</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-6 ftco-animate">
                    <form action="{{ route('user#contact#send') }}" class="contact-form" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Your Name" name="name"
                                        value="{{ old('name', Auth::user()->name) }}">
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Your Email" name="email"
                                        value="{{ old('email', Auth::user()->email) }}">
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Subject" name="title"
                                value="{{ old('title') }}">
                            @error('title')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <textarea name="message" id="" cols="30" rows="7" class="form-control" placeholder="Message">{{ old('message') }}</textarea>
                        </div>
                        @error('message')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <div class="form-group mt-3">
                            <input type="submit" value="Send Message" class="btn btn-warning py-3 px-5">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <div id="map"></div>
@endsection

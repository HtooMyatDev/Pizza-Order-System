@extends('user.layouts.master')

@section('content')
    <section class="home-slider owl-carousel img" style="background-image: url(images/bg_1.jpg);">

        <div class="slider-item" style="background-image: url(images/bg_3.jpg);">
            <div class="overlay"></div>
            <div class="container">
                <div class="row slider-text justify-content-center align-items-center">

                    <div class="col-md-7 col-sm-12 text-center ftco-animate">
                        <h1 class="mb-3 mt-5 bread">Services</h1>
                        <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span>
                            <span>Services</span>
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </section>


    <section class="ftco-section ftco-services">
        <div class="overlay"></div>
        <div class="container">
            <div class="row justify-content-center mb-5 pb-3">
                <div class="col-md-7 heading-section ftco-animate text-center">
                    <h2 class="mb-4">Our Services</h2>
                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live
                        the blind texts.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 ftco-animate">
                    <div class="media d-block text-center block-6 services">
                        <div class="icon d-flex justify-content-center align-items-center mb-5">
                            <span class="flaticon-diet"></span>
                        </div>
                        <div class="media-body">
                            <h3 class="heading">Healthy Foods</h3>
                            <p>Even the all-powerful Pointing has no control about the blind texts it is an almost
                                unorthographic.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 ftco-animate">
                    <div class="media d-block text-center block-6 services">
                        <div class="icon d-flex justify-content-center align-items-center mb-5">
                            <span class="flaticon-bicycle"></span>
                        </div>
                        <div class="media-body">
                            <h3 class="heading">Fastest Delivery</h3>
                            <p>Even the all-powerful Pointing has no control about the blind texts it is an almost
                                unorthographic.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 ftco-animate">
                    <div class="media d-block text-center block-6 services">
                        <div class="icon d-flex justify-content-center align-items-center mb-5"><span
                                class="flaticon-pizza-1"></span></div>
                        <div class="media-body">
                            <h3 class="heading">Original Recipes</h3>
                            <p>Even the all-powerful Pointing has no control about the blind texts it is an almost
                                unorthographic.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-3">
                <div class="col-md-7 heading-section ftco-animate text-center">
                    <h2 class="mb-4 text-warning">Hot Meals</h2>
                    <p class="flip"><span class="deg1"></span><span class="deg2"></span><span class="deg3"></span>
                    </p>
                    <p class="mt-5 text-white">Far far away, behind the word mountains, far from the countries Vokalia and
                        Consonantia, there live the blind texts.</p>
                </div>
            </div>
            <div class="row">
                @foreach ($pizzas as $item)
                    <div class="col-md-3 text-center ftco-animate">
                        <div class="menu-wrap">
                            <a href="{{ route('user#details', $item->id) }}" class="menu-img img mb-4"
                                style="background-image: url({{ asset('pizza/' . $item->photo) }});"></a>
                            <div class="text">
                                <h3><a href="{{ route('user#details', $item->id) }}"
                                        class="text-warning">{{ $item->name }}</a></h3>
                                <p class="text-white">{{ Str::words($item->description, 10, '...') }}</p>
                                <p class="price"><span class="text-warning">{{ $item->price }} mmk</span></p>
                                <p><a href="{{ route('user#details', $item->id) }}"
                                        class="btn btn-white btn-outline-white">Add to
                                        cart</a></p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

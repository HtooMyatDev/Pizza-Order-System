@extends('user.layouts.master')
@section('content')
    <section class="home-slider owl-carousel img" style="background-image: url({{ asset('user/images/bg_1.jpg') }})">
        <div class="slider-item" style="background-image: url({{ asset('user/images/bg_3.jpg') }})">
            <div class="overlay"></div>
            <div class="container">
                <div class="row slider-text justify-content-center align-items-center">
                    <div class="col-md-7 col-sm-12 text-center ftco-animate">
                        <h1 class="mb-3 mt-5 bread">Our Menu</h1>
                        <p class="breadcrumbs">
                            <span class="mr-2"><a href="index.html">Home</a></span>
                            <span>Menu</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-3">
                <div class="col-md-7 heading-section ftco-animate text-center">
                    <h2 class="mb-4 text-warning">Our Menu</h2>
                    <p class="text-white">
                        Far far away, behind the word mountains, far from the countries
                        Vokalia and Consonantia, there live the blind texts.
                    </p>
                </div>
            </div>
        </div>
        <div class="container-wrap">
            <div class="row no-gutters d-flex">`
                @if (count($list) > 3)
                    @for ($index = 0; $index < 3; $index++)
                        <div class="col d-flex ftco-animate">
                            <div class="services-wrap d-flex">
                                <img src="{{ asset('pizza/' . $list[$index]['photo']) }}" class="img h-100 w-50"
                                    style="object-fit: cover;">
                                <div class="text p-4">
                                    <h3 class="text-warning">{{ $list[$index]['name'] }}</h3>
                                    <p class="text-white">{{ Str::words($list[$index]['description'], 15, '...') }}
                                    </p>
                                    <p class="price"><span>{{ $list[$index]['price'] }} mmk</span> <a
                                            href="{{ route('user#details', $list[$index]['id']) }}"
                                            class="ml-2 btn btn-white btn-outline-white">Order</a></p>
                                </div>
                            </div>
                        </div>
                    @endfor
                @endif
            </div>
            <div class="row no-gutters d-flex">
                @if (count($list) > 6)
                    @for ($index = 3; $index < 6; $index++)
                        <div class="col d-flex ftco-animate">
                            <div class="services-wrap d-flex">
                                <img src="{{ asset('pizza/' . $list[$index]['photo']) }}"
                                    class="img order-lg-last h-100 w-50" style="object-fit: cover;">
                                <div class="text p-4">
                                    <h3 class="text-warning">{{ $list[$index]['name'] }}</h3>
                                    <p class="text-white">{{ Str::words($list[$index]['description'], 15, '...') }}
                                    </p>
                                    <p class="price"><span>{{ $list[$index]['price'] }} mmk</span> <a
                                            href="{{ route('user#details', $list[$index]['id']) }}"
                                            class="ml-2 btn btn-white btn-outline-white">Order</a></p>
                                </div>
                            </div>
                        </div>
                    @endfor
                @endif
            </div>
        </div>

        <div class="container">
            <div class="row justify-content-center mb-5 pb-3 mt-5 pt-5">
                <div class="col-md-7 heading-section text-center ftco-animate">
                    <h2 class="mb-4 text-warning">Our Menu Pricing</h2>
                    <p class="flip">
                        <span class="deg1"></span><span class="deg2"></span><span class="deg3"></span>
                    </p>
                    <p class="mt-5 text-white">
                        Far far away, behind the word mountains, far from the countries
                        Vokalia and Consonantia, there live the blind texts.
                    </p>
                </div>
            </div>
            <div class="row">
                @foreach ($list as $item)
                    <div class="col-md-6">
                        <div class="pricing-entry d-flex ftco-animate">
                            <a href="{{ route('user#details', $item->id) }}">
                                <div class="img" style="background-image: url({{ asset('pizza/' . $item->photo) }});">
                                </div>
                            </a>
                            <div class="desc pl-3">
                                <div class="d-flex text align-items-center">
                                    <h3><span class="text-warning">{{ $item->name }}</span></h3>
                                    <span class="price text-warning">{{ $item->price }} mmk</span>
                                </div>
                                <div class="d-block">
                                    <p class="text-white">{{ Str::words($item->description, 10, '...') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="ftco-menu">
        <div class="container-fluid">
            <div class="row d-md-flex">
                <div class="col-lg-4 ftco-animate img f-menu-img mb-5 mb-md-0"
                    style="background-image: url({{ asset('user/images/about.jpg') }})"></div>
                <div class="col-lg-8 ftco-animate p-md-5">
                    <div class="row">
                        <div class="col-md-12 nav-link-wrap mb-5">
                            <div class="nav ftco-animate nav-pills" id="v-pills-tab" role="tablist"
                                aria-orientation="vertical">
                                <a class="nav-link @if (!request('categoryId')) active @endif rounded"
                                    id="v-pills-1-tab" data-toggle="pill" href="{{ route('user#menu') }}" role="tab"
                                    aria-controls="v-pills-1" aria-selected="true">All</a>
                                @foreach ($categories as $item)
                                    <a class="nav-link @if (request('categoryId') == $item->id) active @endif  rounded"
                                        id="v-pills-1-tab" data-toggle="pill"
                                        href="{{ url('user/menu?categoryId=' . $item->id) }}" role="tab"
                                        aria-controls="v-pills-1" aria-selected="true">{{ $item->name }}</a>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-12 d-flex align-items-center">
                            <div class="tab-content ftco-animate" id="v-pills-tabContent">
                                <div class="tab-pane fade show active" id="v-pills-1" role="tabpanel"
                                    aria-labelledby="v-pills-1-tab">
                                    <div class="row">
                                        @foreach ($pizzas as $item)
                                            <div class="col-md-4 text-center">
                                                <div class="menu-wrap">
                                                    <a href="{{ route('user#details', $item->id) }}"
                                                        class="menu-img img mb-4"
                                                        style="background-image: url({{ asset('pizza/' . $item->photo) }})"></a>
                                                    <div class="text">
                                                        <h3><a href="#">{{ $item->name }}</a></h3>
                                                        <p class="text-white">
                                                            {{ Str::words($item->description, 10, '...') }}
                                                        </p>
                                                        <p class="price"><span>{{ $item->price }} mmk</span></p>
                                                        <p>
                                                            <a href="{{ route('user#details', $item->id) }}"
                                                                class="btn btn-outline-warning">Add to
                                                                cart</a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="v-pills-2" role="tabpanel"
                                    aria-labelledby="v-pills-2-tab">
                                    <div class="row">
                                        <div class="col-md-4 text-center">
                                            <div class="menu-wrap">
                                                <a href="#" class="menu-img img mb-4"
                                                    style="background-image: url(images/drink-1.jpg)"></a>
                                                <div class="text">
                                                    <h3><a href="#">Lemonade Juice</a></h3>
                                                    <p>
                                                        Far far away, behind the word mountains, far from
                                                        the countries Vokalia and Consonantia.
                                                    </p>
                                                    <p class="price"><span>$2.90</span></p>
                                                    <p>
                                                        <a href="#" class="btn btn-white btn-outline-white">Add to
                                                            cart</a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 text-center">
                                            <div class="menu-wrap">
                                                <a href="#" class="menu-img img mb-4"
                                                    style="background-image: url(images/drink-2.jpg)"></a>
                                                <div class="text">
                                                    <h3><a href="#">Pineapple Juice</a></h3>
                                                    <p>
                                                        Far far away, behind the word mountains, far from
                                                        the countries Vokalia and Consonantia.
                                                    </p>
                                                    <p class="price"><span>$2.90</span></p>
                                                    <p>
                                                        <a href="#" class="btn btn-white btn-outline-white">Add to
                                                            cart</a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 text-center">
                                            <div class="menu-wrap">
                                                <a href="#" class="menu-img img mb-4"
                                                    style="background-image: url(images/drink-3.jpg)"></a>
                                                <div class="text">
                                                    <h3><a href="#">Soda Drinks</a></h3>
                                                    <p>
                                                        Far far away, behind the word mountains, far from
                                                        the countries Vokalia and Consonantia.
                                                    </p>
                                                    <p class="price"><span>$2.90</span></p>
                                                    <p>
                                                        <a href="#" class="btn btn-white btn-outline-white">Add to
                                                            cart</a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="v-pills-3" role="tabpanel"
                                    aria-labelledby="v-pills-3-tab">
                                    <div class="row">
                                        <div class="col-md-4 text-center">
                                            <div class="menu-wrap">
                                                <a href="#" class="menu-img img mb-4"
                                                    style="background-image: url(images/burger-1.jpg)"></a>
                                                <div class="text">
                                                    <h3><a href="#">Itallian Pizza</a></h3>
                                                    <p>
                                                        Far far away, behind the word mountains, far from
                                                        the countries Vokalia and Consonantia.
                                                    </p>
                                                    <p class="price"><span>$2.90</span></p>
                                                    <p>
                                                        <a href="#" class="btn btn-white btn-outline-white">Add to
                                                            cart</a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 text-center">
                                            <div class="menu-wrap">
                                                <a href="#" class="menu-img img mb-4"
                                                    style="background-image: url(images/burger-2.jpg)"></a>
                                                <div class="text">
                                                    <h3><a href="#">Itallian Pizza</a></h3>
                                                    <p>
                                                        Far far away, behind the word mountains, far from
                                                        the countries Vokalia and Consonantia.
                                                    </p>
                                                    <p class="price"><span>$2.90</span></p>
                                                    <p>
                                                        <a href="#" class="btn btn-white btn-outline-white">Add to
                                                            cart</a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 text-center">
                                            <div class="menu-wrap">
                                                <a href="#" class="menu-img img mb-4"
                                                    style="background-image: url(images/burger-3.jpg)"></a>
                                                <div class="text">
                                                    <h3><a href="#">Itallian Pizza</a></h3>
                                                    <p>
                                                        Far far away, behind the word mountains, far from
                                                        the countries Vokalia and Consonantia.
                                                    </p>
                                                    <p class="price"><span>$2.90</span></p>
                                                    <p>
                                                        <a href="#" class="btn btn-white btn-outline-white">Add to
                                                            cart</a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="v-pills-4" role="tabpanel"
                                    aria-labelledby="v-pills-4-tab">
                                    <div class="row">
                                        <div class="col-md-4 text-center">
                                            <div class="menu-wrap">
                                                <a href="#" class="menu-img img mb-4"
                                                    style="background-image: url(images/pasta-1.jpg)"></a>
                                                <div class="text">
                                                    <h3><a href="#">Itallian Pizza</a></h3>
                                                    <p>
                                                        Far far away, behind the word mountains, far from
                                                        the countries Vokalia and Consonantia.
                                                    </p>
                                                    <p class="price"><span>$2.90</span></p>
                                                    <p>
                                                        <a href="#" class="btn btn-white btn-outline-white">Add to
                                                            cart</a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 text-center">
                                            <div class="menu-wrap">
                                                <a href="#" class="menu-img img mb-4"
                                                    style="background-image: url(images/pasta-2.jpg)"></a>
                                                <div class="text">
                                                    <h3><a href="#">Itallian Pizza</a></h3>
                                                    <p>
                                                        Far far away, behind the word mountains, far from
                                                        the countries Vokalia and Consonantia.
                                                    </p>
                                                    <p class="price"><span>$2.90</span></p>
                                                    <p>
                                                        <a href="#" class="btn btn-white btn-outline-white">Add to
                                                            cart</a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 text-center">
                                            <div class="menu-wrap">
                                                <a href="#" class="menu-img img mb-4"
                                                    style="background-image: url(images/pasta-3.jpg)"></a>
                                                <div class="text">
                                                    <h3><a href="#">Itallian Pizza</a></h3>
                                                    <p>
                                                        Far far away, behind the word mountains, far from
                                                        the countries Vokalia and Consonantia.
                                                    </p>
                                                    <p class="price"><span>$2.90</span></p>
                                                    <p>
                                                        <a href="#" class="btn btn-white btn-outline-white">Add to
                                                            cart</a>
                                                    </p>
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
@endsection

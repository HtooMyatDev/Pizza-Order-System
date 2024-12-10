@extends('user.layouts.master')

@section('content')
    <section class="home-slider owl-carousel img" style="background-image: url({{ asset('user/images/bg_1.jpg') }});">
        <div class="slider-item" style="background-image: url({{ asset('user/images/bg_1.jpg') }});">
            <div class="overlay"></div>
            <div class="container">
                <div class="row slider-text justify-content-center align-items-center">
                    <div class="col-md-7 col-sm-12 text-center ftco-animate">
                        <h1 class="mb-3 mt-5 bread">Order Edit</h1>
                        <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('user#home') }}">Home</a></span>
                            <span><a href="{{ route('user#cart') }}">
                                    Cart</a></span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section style="margin: 150px 0 150px 0; font-weight: bold">
        <div class="row d-flex">
            <div class="col-3 offset-3">
                <img src="{{ asset('pizza/' . $data->photo) }}" class="img-thumbnail"
                    style="height:350px; width:350px; object-fit: cover;">
            </div>
            <div class="col-3">
                <form action="{{ route('user#cart#update') }}" method="post">
                    @csrf
                    <div class="">
                        <h2 class="text-white fw-bold">{{ $data->name }}</h2>
                    </div>
                    <div class="mb-3">
                        <h5 class="text-warning" id="originalPrice" style="font-weight:bold;">{{ $data->price }} mmk<h5>
                        <h6 class="text-white">Base price</h6>
                    </div>
                    <div class="mb-3">
                        <input type="hidden" name="cartId" value="{{ $data->cart_id }}">
                        <div class="d-flex align-items-center text-white">
                            <h5>Additional Sauces </h5>
                            <h6 class="mx-3">Pick 1</h6>
                        </div>
                        @foreach (['Tomato Sauce', 'BBQ Sauce', 'Buffalo Sauce'] as $sauce)
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="{{ $sauce }}"
                                    id="flexCheckDefault" style="accent-color: brown;" name="sauce"
                                    @if ($data->sauce == $sauce) checked @endif>
                                <label class="form-check-label text-warning w-75" for="flexCheckDefault">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="">{{ $sauce }}</h6>
                                    </div>
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <div class="mb-3">
                        <div class="d-flex align-items-center text-white">
                            <h5>Additional Toppings </h5>
                            <h6 class="mx-3">optional</h6>

                        </div>
                        @foreach ($toppings as $item)
                            <div class="form-check">
                                <input class="form-check-input topping" type="checkbox" value="{{ $item->topping }}"
                                    id="flexCheckDefault " style="accent-color: brown;" name="toppings[]"
                                    @if (in_array($item->topping, $selectedToppings)) checked @endif>
                                <label class="form-check-label text-warning w-75" for="flexCheckDefault">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="">{{ $item->topping }}</h6>
                                        <h6 id="toppingPrice">+{{ $item->price }}</h6>
                                    </div>
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <div class="mb-3">
                        <div class="d-flex align-items-center text-white">
                            <h5>Notes to restaurant</h5>
                            <h6 class="mx-3">optional</h6>
                        </div>

                        <textarea name="extraNotes" cols="45" rows="3"
                            placeholder="*specific notes for particular choice & preference*" class="text-warning"
                            style="border:none; outline: none; background-color: transparent;">{{ old('extraNotes', $data->extra_notes) }}</textarea>
                    </div>
                    <div class="input-group quantity mb-4 align-items-center" style="width: 25%;">
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-sm btn-dark btn-minus rounded border">
                                <i class="fa fa-minus text-warning"></i>
                            </button>
                        </div>

                        <input type="text" class="form-control form-control-sm text-center border-0"
                            value="{{ old('quantity', $data->qty) }}" name="quantity" id="quantity">

                        <div class="input-group-btn">
                            <button type="button" class="btn btn-sm btn-dark btn-plus rounded border">
                                <i class="fa fa-plus text-warning"></i>
                            </button>
                        </div>
                    </div>
                    <div class="mb-3" id="btn">
                        <button class="btn btn-outline-warning rounded px-4 d-inline" id="addToCart">Update the order</button>
                        <a class="btn btn-outline-warning rounded px-4 d-none" href="{{ route('user#cart') }}" id="backToMenu">Back
                            to
                            cart</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

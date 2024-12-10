@extends('user.layouts.master')


@section('content')
    <section class="home-slider owl-carousel img" style="background-image: url({{ asset('user/images/bg_1.jpg') }});">
        <div class="slider-item" style="background-image: url({{ asset('user/images/bg_1.jpg') }});">
            <div class="overlay"></div>
            <div class="container">
                <div class="row slider-text justify-content-center align-items-center">
                    <div class="col-md-7 col-sm-12 text-center ftco-animate">
                        <h1 class="mb-3 mt-5 bread">Details</h1>
                        <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('user#home') }}">Home</a></span>
                            <span>Details</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="my-5">

        {{-- details start --}}
        <div class="row w-100 d-flex align-items-center">
            <div class="col-4 offset-2">
                <img src="{{ asset('pizza/' . $pizza->photo) }}" class="img-thumbnail rounded-circle shadow-4-strong"
                    style="width: 450px; height: 450px; object-fit: cover">
            </div>
            <div class="col-5">
                <h1 class="text-warning fw-bold">{{ $pizza->name }}</h1>
                <h5 class="text-white my-2">Category: {{ $pizza->pizza_category }}</h5>
                <div class="mb-3 d-flex">
                    @php $ratings = number_format($ratings); @endphp
                    @for ($i = 0; $i < $ratings; $i++)
                        <i class="fa fa-star text-warning"></i>
                    @endfor
                    @for ($j = $ratings + 1; $j <= 5; $j++)
                        <i class="fa fa-star text-white"></i>
                    @endfor
                </div>
                <div class="mb-3">
                    <h5 class="text-warning" id="originalPrice" style="font-weight:bold;">{{ $pizza->price }} mmk</h5>
                    <h6 class="text-white">Base price</h6>
                </div>
                <p class="mb-3 text-white">{{ $pizza->description }}</p>

                <form action="{{ route('user#addToCart') }}" method="POST">
                    @csrf
                    <input type="hidden" name="userID" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="pizzaID" value="{{ $pizza->id }}">
                    <input type="hidden" name="containerCharges" value="500">

                    <div class="mb-3">
                        <div class="mb-3">
                            <div class="d-flex align-items-center">
                                <h4 class="fw-bold text-white ">Container Charges</h4>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" checked id="flexCheckDefault">
                                <label class="form-check-label text-warning w-75" for="flexCheckDefault">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="fw-bold">container charges</h6>
                                        <h6>+{{ number_format(500, 2) }}</h6>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="mb-3">
                            <div class="d-flex align-items-center">
                                <h4 class="fw-bold text-white">Additional Sauces </h4>
                                <h6 class="mx-3">Pick 1</h6>
                            </div>
                            @foreach (['Tomato Sauce', 'BBQ Sauce', 'Buffalo Sauce'] as $sauce)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="{{ $sauce }}"
                                        id="flexCheckDefault" style="accent-color: brown;" name="sauce">
                                    <label class="form-check-label text-warning w-75" for="flexCheckDefault">
                                        <div class="d-flex justify-content-between">
                                            <h6 class="fw-bold">{{ $sauce }}</h6>
                                        </div>
                                    </label>
                                </div>
                            @endforeach
                            @error('sauce')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="d-flex align-items-center">
                            <h5 class="fw-bold text-white">Additional Toppings </h5>
                            <h6 class="mx-3 text-white">optional</h6>

                        </div>
                        @foreach ($toppings as $item)
                            <div class="form-check">
                                <input class="form-check-input topping" type="checkbox"
                                    @if ($item->count == 0) disabled @endif value="{{ $item->topping }}"
                                    id="flexCheckDefault " name="toppings[]">
                                <label class="form-check-label text-warning w-75" for="flexCheckDefault">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="fw-bold">{{ $item->topping }}</h6>
                                        <h6 id="toppingPrice ">+{{ $item->price }}</h6>
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
                            style="border:none; outline: none; background-color: transparent;"></textarea>
                    </div>

                    <div class="input-group quantity mb-4 align-items-center" style="width: 25%;">
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-sm btn-dark btn-minus rounded border">
                                <i class="fa fa-minus text-warning"></i>
                            </button>
                        </div>

                        <input type="text" class="form-control form-control-sm text-center border-0"
                            value="{{ old('quantity', 1) }}" name="quantity" id="quantity">

                        <div class="input-group-btn">
                            <button type="button" class="btn btn-sm btn-dark btn-plus rounded border">
                                <i class="fa fa-plus text-warning"></i>
                            </button>
                        </div>
                    </div>
                    <div class="mb-3" id="btn">
                        <button class="btn btn-outline-warning rounded px-4 d-inline" id="addToCart">Add to cart</button>
                        <a class="btn btn-outline-warning rounded px-4 d-none" href="{{ route('user#menu') }}"
                            id="backToMenu">Back to
                            menu</a>
                        <button type="button" class="btn btn-outline-warning ms-3 px-4 py-2" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            Rate this product
                        </button>
                    </div>

                </form>
            </div>
        </div>
        <form action="{{ route('user#rating') }}" method="post">
            <!-- Modal -->


            <input type="hidden" name="pizzaId" value="{{ $pizza->id }}">
            @csrf
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content bg-dark">
                        <div class="modal-header">
                            <h1 class="modal-title fw-bold text-warning fs-5" id="exampleModalLabel">Rate this
                                pizza
                            </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="rating-css">
                                <div class="star-icon">
                                    @php $personalRating = number_format($personalRating); @endphp

                                    @if ($personalRating == 0)
                                        <input type="radio" value="1" name="productRating" id="rating1"
                                            checked>
                                        <label for="rating1" class="">
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                        </label>
                                        <input type="radio" value="2" name="productRating" id="rating2">
                                        <label for="rating2">
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                        </label>
                                        <input type="radio" value="3" name="productRating" id="rating3">
                                        <label for="rating3">
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                        </label>
                                        <input type="radio" value="4" name="productRating" id="rating4">
                                        <label for="rating4">
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                        </label>
                                        <input type="radio" value="5" name="productRating" id="rating5">
                                        <label for="rating5">
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                        </label>
                                    @else
                                        @for ($i = 1; $i <= $personalRating; $i++)
                                            <input type="radio" value="{{ $i }}" name="productRating"
                                                id="rating{{ $i }}" checked>
                                            <label for="rating{{ $i }}" class="">
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                            </label>
                                        @endfor


                                        @for ($j = $personalRating + 1; $j <= 5; $j++)
                                            <input type="radio" value="{{ $j }}" name="productRating"
                                                id="rating{{ $j }}">
                                            <label for="rating{{ $j }}">
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                            </label>
                                        @endfor
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-danger rounded"
                                data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-outline-warning rounded">Save
                                changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="row w-100">
            <div class="col offset-2 my-3" style="font-size: 15px;">
                <span class="text-warning"><i class="fa-solid fa-eye mx-2"></i>{{ $views }}</span> <span
                    class="text-white">
                    seen
                </span>
            </div>
        </div>
        {{-- details end --}}


        <div class="row w-100">
            {{-- comments start --}}
            <div class="col-5 offset-2">
                <div class="pt-5 mt-5">
                    <h3 class="mb-5 text-white">{{ count($comments) }} @if (count($comments) > 1)
                            comments
                        @else
                            comment
                        @endif
                    </h3>
                    <ul class="comment-list">`
                        @foreach ($comments as $comment)
                            <li class="comment">
                                <div class="vcard bio">
                                    <img src="{{ asset(Auth::user()->profile ? 'profile/' . Auth::user()->profile : 'profile/default.jpeg') }}"
                                        alt="Image placeholder">
                                </div>
                                <div class="comment-body">
                                    <h3 class="text-white">{{ $comment->name }}</h3>
                                    <div class="meta">{{ $comment->created_at->format('j F, Y') }} at
                                        {{ date('H:i', strtotime($comment->created_at)) }}
                                        {{ $comment->created_at->format('a') }}</div>
                                    <p class="text-white">{{ $comment->comment }}</p>
                                    <p><a href="#" class="reply">Reply</a>
                                        @if (Auth::user()->id == $comment->user_id)
                                            <a href="{{ route('user#comment#delete', $comment->comment_id) }}"
                                                class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></a>
                                        @endif
                                    </p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <!-- END comment-list -->

                    <div class="comment-form-wrap pt-5">
                        <h3 class="mb-5 text-white">Leave a comment</h3>
                        <form action="{{ route('user#action#comment') }}" method="post">
                            @csrf
                            <div class="form-group shadow">
                                <input type="hidden" name="pizzaId" value="{{ $pizza->id }}">
                                <label for="message" class="text-warning">Message</label>
                                <textarea name="message" cols="30" rows="10" class="form-control"></textarea>
                                @error('message')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group shadow">
                                <input type="submit" value="Post Comment" class="btn py-3 px-4 btn-outline-warning">
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            {{-- comments end --}}

            {{-- others start --}}
            <div class="col offset-1">
                <div class="row">
                    <h3 class="text-warning">Other Pizzas</h3>
                </div>
                @foreach ($pizzaList as $item)
                    <div class="row">
                        <div class="col">
                            <div class="card mb-3 w-75 shadow bg-dark">
                                <a href="{{ route('user#details', $item->id) }}" rel="noopener noreferrer">
                                    <img src="{{ asset('pizza/' . $item->photo) }}" class="card-img-top w-100"
                                        alt="..." style="height: 250px; width: 250px; object-fit: cover">
                                </a>
                                <div class="card-body bg-transparent" style="">
                                    <h4 class="card-title text-warning fw-bold">{{ $item->name }}</h4>
                                    <p class="card-text text-white">{{ Str::words($item->description, 15, '...') }}</p>
                                    <p class="card-text"><small class="text-secondary">Last updated at
                                            {{ $item->updated_at->format('j F, Y') }}</small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{-- others end --}}
        </div>

    </section>
@endsection

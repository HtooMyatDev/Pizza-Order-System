@extends('user.layouts.master')

@section('content')
    <section class="home-slider owl-carousel img" style="background-image: url({{ asset('user/images/bg_1.jpg') }});">
        <div class="slider-item" style="background-image: url({{ asset('user/images/bg_1.jpg') }});">
            <div class="overlay"></div>
            <div class="container">
                <div class="row slider-text justify-content-center align-items-center">
                    <div class="col-md-7 col-sm-12 text-center ftco-animate">
                        <h1 class="mb-3 mt-5 bread">Cart</h1>
                        <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('user#home') }}">Home</a></span>
                            <span>Cart</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section style="margin: 150px 0 150px 0; font-weight: bold">
        <div class="row">
            <div class="col-10 offset-1 text-center">
                <table class="table table-hover table-dark " id="productTable">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Pizza</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Pizza Quantity</th>
                            <th scope="col">Sauce</th>
                            <th scope="col">Additional Toppings</th>
                            <th scope="col">Total</th>
                            <th scope="col">Handle</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <input type="hidden" id="userId" value="{{ Auth::user()->id }}">
                        @if (count($products) > 0)
                            @foreach ($products as $product)
                                <tr>
                                    <td class="text-warning">
                                        <input type="hidden" id="cartId" value="{{ $product->cart_id }}" id="cartId">
                                        <input type="hidden" class="pizzaId" value="{{ $product->pizza_id }}">
                                        {{ $product->cart_id }}
                                    </td>
                                    <td>
                                        <img src="{{ asset('pizza/' . $product->photo) }}" class="img-thumbnail"
                                            style="width: 120px; height: 120px; object-fit: cover">
                                    </td>
                                    <td class="text-warning">{{ $product->name }}</td>
                                    <td>{{ $product->price }}
                                        <span class="text-warning"> mmk</span>
                                    </td>
                                    <td class="qty">{{ $product->qty }}
                                        <span class="text-warning">
                                            @if ($product->qty > 1)
                                                pcs
                                            @endif
                                        </span>
                                    </td>
                                    <td class="text-warning sauce">
                                        {{ $product->sauce }}
                                    </td>
                                    <td class="text-warning toppings">
                                        @if ($product->toppings != null)
                                            {{ $product->toppings }}
                                        @else
                                            <span class="btn btn-danger rounded" style="font-weight: 700;">No Toppings
                                            </span>
                                        @endif

                                    </td>
                                    <td>
                                        @php
                                            $toppingPrice = [];
                                            $toppingArr = explode(' / ', $product->toppings);
                                            for ($i = 0; $i < count($toppingArr); $i++) {
                                                for ($j = 0; $j < count($toppings); $j++) {
                                                    if ($toppingArr[$i] == $toppings[$j]->topping) {
                                                        array_push($toppingPrice, $toppings[$j]->price);
                                                    }
                                                }
                                            }
                                        @endphp
                                        {{ array_sum($toppingPrice) + $product->qty * $product->price }}
                                        <span class="text-warning">mmk</span>
                                    </td>
                                    <td>

                                        <form action="{{ route('user#cart#edit') }}" method="POST" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="pizza_category_id"
                                                value="{{ $product->pizza_category_id }}">
                                            <input type="hidden" value="{{ $product->cart_id }}" name="cartId">
                                            <button class=" btn btn-warning rounded text-white bts-sm">
                                                <i class="fa-solid fa-pen-to-square fs-5"></i>
                                            </button>
                                        </form>

                                        <button class=" btn btn-danger rounded btn-remove bts-sm">
                                            <i class="fa-solid fa-trash fs-5"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="9" class="text-center bg-danger h1 rounded" style="font-weight: 800;">
                                    You haven't ordered anything yet!
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <div class="row g-4 justify-content-end">
        <div class="col-6"></div>
        <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
            <div class="rounded">
                <div class="p-4" style="font-weight:800;">
                    <h1 class="display-6 mb-4 text-white" style="font-weight:800;">Cart <span
                            class="text-warning">Total</span></h1>
                    <div class="d-flex justify-content-between mb-4">
                        <h5 class="mb-0 me-4 text-white" style="font-weight:800;">Subtotal:</h5>
                        <p class="mb-0 text-warning" id="subTotal">
                            {{ $total }} mmk</p>
                    </div>
                    <div class="d-flex justify-content-between mb-4">
                        <h5 class="mb-0 me-4 text-white" style="font-weight:800;">Container Charges per 1pc</h5>
                        <div class="">
                            <p class="mb-0 text-danger">Flat rate: <span class="text-warning">
                                    500 mmk</span></p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h5 class="mb-0 me-4 text-white" style="font-weight:800;">Shipping</h5>
                        <div class="">
                            <p class="mb-0 text-danger">Flat rate: <span class="text-warning">
                                    2500 mmk</span></p>
                        </div>
                    </div>
                </div>
                <div class="p-4">
                    <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                        <h5 class="mb-0 ps-4 me-4 text-white" style="font-weight:800;">Total</h5>
                        <p class="mb-0 pe-4 text-warning" id="finalTotal" style="font-weight:800;">
                            {{ $total + 500 + 2500 }} mmk</p>
                    </div>
                </div>
                <div class="px-4 mb-3">
                    <button id="btn-checkout" @if (count($products) == 0) disabled @endif style="font-weight: 800;"
                        class="px-5 py-3 text-uppercase btn btn-outline-warning rounded">Proceed
                        Checkout</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('jQuery')
    <script>
        $(document).ready(function() {
            $('.btn-remove').click(function() {
                $parentNode = $(this).parents('tr');
                $cartId = $parentNode.find('#cartId').val()

                $data = {
                    'cartId': $cartId
                }

                $.ajax({
                    type: 'get',
                    data: $data,
                    url: '/user/cart/delete',
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 'success') {
                            location.reload();
                        }
                    }
                })

            })
            $('#btn-checkout').click(function() {
                $orderList = [];
                $userId = $('#userId').val();
                $orderCode = "PI-FREN-" + Math.floor(Math.random() * 100000000);
                $finalTotal = $('#finalTotal').text().replace('mmk', '') * 1;

                $('#productTable tbody tr').each(function(index, row) {
                    $pizzaId = $(row).find('.pizzaId').val()
                    $qty = $(row).find('.qty').text().replace('pcs', '') * 1
                    $sauce = $(row).find('.sauce').text()
                    $toppings = $(row).find('.toppings').text()

                    $orderList.push({
                        'user_id': $userId,
                        'pizza_id': $pizzaId,
                        'order_code': $orderCode,
                        'qty': $qty,
                        'toppings': $toppings,
                        'sauce': $sauce,
                        'total_amt': $finalTotal
                    })
                })
                $.ajax({
                    type: 'get',
                    url: '/user/order/store',
                    data: Object.assign({}, $orderList),
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 'success') {
                            location.href = '/user/order/payment'
                        }
                    }
                })
            })
        })
    </script>
@endsection

@extends('admin.layouts.master')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Orders</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Order's Details</li>
            </ol>
        </div>
    </main>

    <section>
        <div class="row mx-4">
            <a href="{{ route('admin#order#list') }}" class="btn btn-primary rounded shadow-sm">Return</a>
        </div>
        <div class="row m-3">
            <div class="col">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary">
                        <h4 class="text-white fw-bold mt-2">
                            User Information
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="mt-3 row">
                            <h5 class="text-primary">Name:</h5>
                            <h5>{{ $orderData[0]['user_name'] }}</h5>
                        </div>

                        <div class="mt-3 row">
                            <h5 class="text-primary">Phone:</h5>
                            <h5>
                                @if ($orderData[0]->user_phone && $orderData[0]->user_phone != $paymentHistoryData->phone)
                                    {{ $orderData[0]->user_phone }} /
                                @endif
                                {{ $paymentHistoryData->phone }}
                            </h5>
                        </div>

                        <div class="mt-3 row">
                            <h5 class="text-primary">Address:</h5>
                            <h5>{{ $orderData[0]['user_address'] }}</h5>
                        </div>

                        <div class="mt-3 row">
                            <h5 class="text-primary">Email:</h5>
                            <h5>{{ $orderData[0]['user_email'] }}</h5>
                        </div>

                        <div class="mt-3 row">
                            <h5 class="text-primary">Order Code:</h5>
                            <h5 id="orderCode">{{ $paymentHistoryData->order_code }}</h5>
                        </div>

                        <div class="mt-3 row">
                            <h5 class="text-primary">Order Date:</h5>
                            <h5>Ordered at {{ $paymentHistoryData->created_at->format('H:m') }}
                                {{ $paymentHistoryData->created_at->format('A') }} on
                                {{ $paymentHistoryData->created_at->format('j F, Y') }}</h5>
                        </div>

                        <div class="mt-3 row">
                            <h5 class="text-primary">Total Amount:</h5>
                            <h5>{{ $paymentHistoryData->total_amt }} mmk</h5>
                            <span class="text-danger">*includes container charges and price of toppings*</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <div class="col">
                        <div class="card shadow-sm">
                            <div class="card-header bg-primary">
                                <h4 class="text-white fw-bold mt-2">
                                    Order Information
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="mt-3 row">
                                    <h5 class="text-primary">Contact Number</h5>
                                    <h5>{{ $paymentHistoryData->phone }}</h5>
                                </div>
                                <div class="mt-3 row">
                                    <h5 class="text-primary">Payment Method</h5>
                                    <h5>{{ $paymentHistoryData->payment_method == 'COD' ? 'Cash' : $paymentHistoryData->payment_method }}
                                    </h5>
                                </div>
                                <div class="mt-3 row">
                                    <h5 class="text-primary">Purchase Date</h5>
                                    <h5>Ordered at {{ $paymentHistoryData->created_at->format('H:m') }}
                                        {{ $paymentHistoryData->created_at->format('A') }} on
                                        {{ $paymentHistoryData->created_at->format('j F, Y') }}</h5>
                                </div>
                                @if ($paymentHistoryData->payslip_image)
                                    <div class="mt-3 row">
                                        <div class="text-primary">Payslip</div>
                                        <h5>{{ $paymentHistoryData->payslip_image }}</h5>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <div class="card shadow-sm">
                            <div class="card-header bg-primary">
                                <h4 class="text-white fw-bold mt-2">
                                    Order Board
                                </h4>
                            </div>
                            <div class="card-body">
                                <table class="table table-hover shadow-sm" id="productTable">
                                    <thead class="thead">
                                        <tr class="">
                                            <th scope="col" >Image</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Count</th>
                                            <th scope="col">Pizza Price (each)</th>
                                            <th scope="col">Toppings</th>
                                            <th scope="col">Sauce</th>
                                            <th scope="col">Total Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orderData as $item)
                                            <tr>
                                                <td>
                                                    <img src="{{ asset('pizza/' . $item->pizza_photo) }}"
                                                        class="img-thumbnail img-profile shadow-sm"
                                                        style="object-fit: cover; width:75px; height:75px; object-fit: cover;">
                                                </td>
                                                <td>{{ $item->pizza_name }}</td>
                                                <td>{{ $item->pizza_count }}</td>
                                                <td>{{ $item->pizza_price }} mmk</td>
                                                <td>{{ $item->pizza_toppings }}</td>
                                                <td>{{ $item->pizza_sauce }}</td>
                                                <td>{{ $item->pizza_price * $item->pizza_count }} mmk</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-3 d-flex flex-row">
                    <div>
                        <button @if ($orderData[0]['order_status'] != 0) disabled @endif
                            class="btn btn-outline-primary fw-bold rounded me-1 font-weight-bold "
                            id="btn-confirm">Confirm</button>
                    </div>
                    <div>
                        <button @if ($orderData[0]['order_status'] != 0) disabled @endif
                            class="btn btn-outline-danger  fw-bold rounded ms-1 font-weight-bold "
                            id="btn-cancel">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('jQuery')
    <script>
        $(document).ready(function() {

            $('#btn-confirm').click(function() {
                $data = {
                    'order_code': $('#orderCode').text()
                }
                $.ajax({
                    type: 'get',
                    url: '/admin/order/confirm',
                    data: $data,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 'success') {
                            location.href = '/admin/order/list';
                        }
                    }
                })
            })

            $('#btn-cancel').click(function() {
                $data = {
                    'order_code': $('#orderCode').text()
                }
                $.ajax({
                    type: 'get',
                    url: '/admin/order/reject',
                    data: $data,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 'success') {
                            location.href = '/admin/order/list';
                        }
                    }
                })
            })
        })
    </script>
@endsection

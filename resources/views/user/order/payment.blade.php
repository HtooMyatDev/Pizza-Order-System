@extends('user.layouts.master')

@section('content')
    <section class="home-slider owl-carousel img" style="background-image: url({{ asset('user/images/bg_1.jpg') }});">
        <div class="slider-item" style="background-image: url({{ asset('user/images/bg_1.jpg') }});">
            <div class="overlay"></div>
            <div class="container">
                <div class="row slider-text justify-content-center align-items-center">
                    <div class="col-md-7 col-sm-12 text-center ftco-animate">
                        <h1 class="mb-3 mt-5 bread">Order</h1>
                        <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('user#home') }}">Home</a></span>
                            <span>Order</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section style="margin:150px 0 150px 0;">
        <div class="row px-5">
            <div class="col-4">
                <div class="card bg-warning shadow-sm">
                    <div class="card-header bg-dark m-1">
                        <h2 style="font-weight:800;" class="mt-3 text-white">Payment Methods</h2>
                    </div>
                    <div class="card-body bg-dark rounded m-1">
                        <div class="p-2 text-center">
                            <table class="table table-hover table-dark">
                                <thead>
                                    <tr>
                                        <th class="text-warning" scope="col">ID</th>
                                        <th class="text-warning" scope="col">Account Type</th>
                                        <th class="text-warning" scope="col">Account Number</th>
                                        <th class="text-warning" scope="col">Account Name</th>
                                    </tr>
                                </thead>
                                <tbody class="fw-bold">
                                    @foreach ($payments as $payment)
                                        <tr>
                                            <td>{{ $payment->id }}</td>
                                            <td>{{ $payment->account_type }}</td>
                                            <td>{{ $payment->account_number }}</td>
                                            <td>{{ $payment->account_name }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <form action="{{ route('user#order#make') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card bg-warning shadow-sm rounded">
                        <div class="card-header bg-dark m-1">
                            <div class="row">
                                <div class="col">
                                    <h2 style="font-weight:800;" class="mt-3 text-white">Payslip Image</h2>
                                </div>
                                <div class="col">
                                    <h2 style="font-weight:800;" class="mt-3 text-white">Customer Information</h2>
                                </div>
                            </div>
                        </div>
                        <div class="card-body bg-dark rounded m-1">
                            <div class="row">
                                <div class="col">
                                    <img src="{{ asset('pizza/default.png') }}" class="img-thumbnail mb-2"
                                        style="width: 400px; height:450px; object-fit: cover;" id="output">
                                    <input type="file" class="form-control mt-2" onchange="loadFile(event)"
                                        name="payslipImage">
                                    @error('payslipImage')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror

                                    <p class="text-secondary fw-bold mt-3">*You don't need to include payslip image if you
                                        choose Cash On Deli!*</p>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="name" class="form-label text-warning fw-bold">Name</label>
                                        <input type="text" disabled class="form-control" id="name"
                                            value="{{ Auth::user()->name }}" aria-describedby="emailHelp">
                                    </div>

                                    <div class="mb-3">
                                        <label for="address" class="form-label text-warning fw-bold">Address</label>
                                        <input type="text" class="form-control" id="address" name="address"
                                            placeholder="Enter your Address..."
                                            value="{{ old('address', Auth::user()->address) }}">
                                        @error('address')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="phone" class="form-label text-warning fw-bold">Phone</label>
                                        <input type="phone" class="form-control" id="phone" name="phone"
                                            placeholder="Enter your Phone Number..."
                                            value="{{ old('phone', Auth::user()->phone) }}">
                                        @error('phone')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="paymentType" class="form-label text-warning fw-bold">Payment
                                            Type</label>
                                        <select class="form-select" name="paymentType">
                                            <option value="">Choose Payment Method...</option>
                                            <option value="COD" @if (old('paymentType') == 'COD') selected @endif>Cash On
                                                Deli
                                            </option>
                                            @foreach ($payments as $payment)
                                                <option value="{{ $payment->account_type }}"
                                                    @if (old('paymentType') == $payment->account_type) selected @endif>
                                                    {{ $payment->account_type }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('paymentType')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label text-warning fw-bold">Order Code</label>
                                        <span class="d-block text-white fw-bold">{{ $data[0]['order_code'] }}</span>
                                        <input type="hidden" name="orderCode" value="{{ $data[0]['order_code'] }}">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label text-warning fw-bold">Total Amount</label>
                                        <input type="hidden" class="d-block text-white fw-bold"
                                            value="{{ $data[0]['total_amt'] }}">
                                        <span class="d-block text-white fw-bold">{{ $data[0]['total_amt'] }} mmk</span>
                                        <input type="hidden" name="totalAmt" value="{{ $data[0]['total_amt'] }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center mt-2">
                                <button class="w-50 btn btn-lg btn-outline-warning rounded fw-bold">Order Now</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

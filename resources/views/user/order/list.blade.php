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

    <section style="margin: 100px 0px 100px 0px;">
        <div class="row">
            <div class="col-6 offset-3">
                <div class="card bg-warning">
                    <div class="card-header bg-warning">
                    </div>
                    <div class="card-body shadow-sm bg-dark">
                        <table class="table table-hovershadow-sm table-dark">
                            <thead class="thead">
                                <tr class="">
                                    <th scope="col" class="text-warning">Date</th>
                                    <th scope="col" class="text-warning">Order Code</th>
                                    <th scope="col" class="text-warning">Status</th>
                                    <th scope="col" class="text-warning">Handle</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <th scope="row">{{ $item->created_at->format('j-F-Y') }}</th>
                                        <td>{{ $item->order_code }}</td>
                                        <td>
                                            @if ($item->status == 0)
                                                <span class="btn btn-sm btn-warning rounded text-white">Pending</span>
                                            @elseif ($item->status == 1)
                                                <span class="btn btn-sm btn-success rounded text-white">Confirm
                                                </span>
                                                <span class="text-danger mx-3"> <i
                                                        class="fa-solid fa-hourglass-half mx-1"></i>
                                                    Waiting time <b>45 minutes</b></span>
                                            @else
                                                <span class="btn btn-danger rounded text-white">Reject</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-danger text-white rounded"
                                                @if ($item->status != 0) disabled @endif>
                                                <a href="{{ route('user#order#delete', $item->order_code) }}"
                                                    class="text-white">Cancel
                                                    Order</a>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

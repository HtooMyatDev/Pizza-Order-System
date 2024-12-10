@extends('admin.layouts.master')
@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Orders</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Confirmed Order List</li>
            </ol>
        </div>
    </main>

    <form action="{{ route('admin#order#list') }}" method="post ">
        <div class="row mx-3">
            <div class="col-2">
                <div class="d-flex justify-content-center align-items-center">
                    <input type="text" class="form-control" placeholder="Order Code..." name="searchKey">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </div>
        </div>
        <div class="row m-3">
            <div class="col">
                <div class="col">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary"></div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Order ID</th>
                                        <th scope="col">Customer Name</th>
                                        <th scope="col">Order Code</th>
                                        <th scope="col">Status</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody class="table-group-divider">
                                    @if (count($orders) > 0)
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td>{{ $order->id }}</td>
                                                <td>{{ $order->name }}</td>
                                                <td>
                                                    <a
                                                        href="{{ route('admin#order#details', $order->order_code) }}">{{ $order->order_code }}</a>
                                                </td>
                                                <td>
                                                    <span class="fw-bold btn btn-success rounded">
                                                        Confirmed
                                                    </span>
                                                </td>

                                                <td class="">

                                                    <div style="margin-top:10px; height:15px; width: 15px; border-radius:100%;"
                                                        class="bg-success"></div>
                                                </td>
                                            <tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="8" class="text-center h5 text-danger">Customers haven't made any
                                                order yet!</td>
                                        </tr>
                                    @endif

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

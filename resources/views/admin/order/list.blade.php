@extends('admin.layouts.master')
@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Orders</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Order List</li>
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
                                            @if ($order->status != 1)
                                                <tr>
                                                    <td>{{ $order->id }}</td>
                                                    <input type="hidden" class="orderCode"
                                                        value="{{ $order->order_code }}">
                                                    <td>{{ $order->name }}</td>
                                                    <td>
                                                        <a
                                                            href="{{ route('admin#order#details', $order->order_code) }}">{{ $order->order_code }}</a>
                                                    </td>
                                                    <td>
                                                        <select name="orderStatus"
                                                            @if ($order->status == 1) disabled @endif
                                                            class="form-control changeStatus">
                                                            <option value="0"
                                                                @if ($order->status == 0) selected @endif>Pending
                                                            </option>
                                                            <option value="1"
                                                                @if ($order->status == 1) selected @endif>Confirm
                                                            </option>
                                                            <option value="2"
                                                                @if ($order->status == 2) selected @endif>Reject
                                                            </option>
                                                        </select>
                                                    </td>

                                                    <td class="">
                                                        @if ($order->status == 1)
                                                            <div style="margin-top:11px; height:15px; width: 15px; border-radius:100%;"
                                                                class="bg-success"></div>
                                                        @endif

                                                        @if ($order->status == 0)
                                                            <div style="margin-top:11px; height:15px; width: 15px; border-radius:100%;"
                                                                class="bg-warning"></div>
                                                        @endif

                                                        @if ($order->status == 2)
                                                            <div style="margin-top:11px; height:15px; width: 15px; border-radius:100%;"
                                                                class="bg-danger"></div>
                                                        @endif
                                                    </td>
                                                <tr>
                                            @endif
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

@section('jQuery')
    <script>
        $(document).ready(function() {
            $('.changeStatus').change(function() {
                $status = $(this).val();
                $orderCode = $(this).parents('tr').find('.orderCode').val();
                $data = {
                    'status': $status,
                    'order_code': $orderCode
                }
                $.ajax({
                    type: 'GET',
                    url: '/admin/order/changeStatus',
                    data: $data,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 'success') {
                            location.reload();
                        }
                    }
                })

            })
        })
    </script>
@endsection

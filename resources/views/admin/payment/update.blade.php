@extends('admin.layouts.master')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Payment Method</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Payment Method Edit</li>
            </ol>

            <div class="row">
                <div class="col-8 offset-2">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary"></div>
                        <div class="card-body">
                            <form action="{{ route('admin#payment#edit') }}" method="POST">
                                @csrf
                                <input type="hidden" name="paymentID" value="{{$payment->id}}">
                                <div class="mb-3">
                                    <h5 class="fw-bold">Account Name</h5>
                                    <input type="text" name="accountName"
                                        value="{{ old('accountName', $payment->account_name) }}"
                                        placeholder="Enter account name..."
                                        class="form-control @error('accountName')
                                            is-invalid
                                        @enderror">
                                    @error('accountName')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <h5 class="fw-bold">Account Number</h5>
                                    <input type="text" name="accountNumber"
                                        value="{{ old('accountNumber', $payment->account_number) }}"
                                        placeholder="Enter account number..."
                                        class="form-control @error('accountNumber')
                                            is-invalid
                                        @enderror">
                                    @error('accountNumber')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <h5 class="fw-bold">Account Type</h5>
                                    <select name="accountType"
                                        class="form-select @error('accountType')
                                        is-invalid
                                    @enderror">
                                        <option value="">Choose Payment Method</option>
                                        @foreach (['KBZPay', 'KBZBank', 'AYABank', 'ABank', 'CBPay'] as $method)
                                            <option value="{{ $method }}"
                                                @if (old('accountType', $payment->account_type) == $method) selected @endif>{{ $method }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('accountType')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <a href="{{ route('admin#payment') }}" class="btn btn-success">Return</a>
                                    <button class="btn btn-outline-primary">Update</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </main>
@endsection

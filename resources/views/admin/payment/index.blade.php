@extends('admin.layouts.master')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Payment Method</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Payment Method</li>
            </ol>
        </div>
    </main>
    <div class="row m-4">
        <div class="row">
            <div class="col-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary"></div>
                    <div class="card-body">
                        <form action="{{ route('admin#payment#create') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <h6 class="fw-bold">Account Name</h6>
                                <input type="text" name="accountName" value="{{ old('accountName') }}"
                                    placeholder="Enter account name..."
                                    class="form-control @error('accountName')
                                        is-invalid
                                    @enderror">
                                @error('accountName')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <h6 class="fw-bold">Account Number</h6>
                                <input type="text" name="accountNumber" value="{{ old('accountNumber') }}"
                                    placeholder="Enter account number..."
                                    class="form-control @error('accountNumber')
                                        is-invalid
                                    @enderror">
                                @error('accountNumber')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <h6 class="fw-bold">Account Type</h6>
                                <select name="accountType"
                                    class="form-select @error('accountType')
                                    is-invalid
                                @enderror">
                                    <option value="">Choose Payment Method</option>
                                    @foreach (['KBZPay', 'KBZBank', 'AYABank', 'ABank', 'CBPay'] as $method)
                                        <option value="{{ $method }}"
                                            @if (old('accountType') == $method) selected @endif>{{ $method }}</option>
                                    @endforeach
                                </select>
                                @error('accountType')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <button class="btn btn-outline-primary">Create</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary"></div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Account Name</th>
                                    <th scope="col">Account Number</th>
                                    <th scope="col">Account Type</th>
                                    <th scope="col">Created at</th>
                                    <th scope="col">Updated at</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                @foreach ($payments as $payment)
                                    <tr>
                                        <th scope="row">{{ $payment->id }}</th>
                                        <td>{{ $payment->account_name }}</td>
                                        <td>{{ $payment->account_number }}</td>
                                        <td>{{ $payment->account_type }}</td>
                                        <td>{{ $payment->created_at->format('j-F-Y') }}</td>
                                        <td>{{ $payment->updated_at->format('j-F-Y') }}</td>
                                        <td>
                                            <a href="{{ route('admin#payment#delete', $payment->id) }}"><i
                                                    class="fa-solid fa-trash-can btn btn-md btn-outline-danger rounded"></i></a>

                                            <a href="{{ route('admin#payment#editPage', $payment->id) }}"><i
                                                    class="fa-solid fa-pen-to-square btn btn-md btn-outline-primary"></i></a>
                                        </td>
                                    <tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

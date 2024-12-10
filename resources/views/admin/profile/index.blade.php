@extends('admin.layouts.master')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Admin Profile</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Admin Profile Detail</li>
            </ol>

            <div class="row">
                <div class="col-6 offset-3">
                    <div class="card">
                        <div class="card-header bg-primary">

                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">
                                    <img src="{{ asset(Auth::user()->profile == null ? 'admin/img/default.jpg' : 'profile/' . Auth::user()->profile) }}"
                                        class="img-thumbnail img-fluid border rounded"
                                        style="height: 250px; width:250px; object-fit: cover">
                                </div>
                                <div class="col-8 ">
                                    <div class="d-flex mt-3">
                                        <div class="col-2">
                                            <h6 class="fw-bold">Name:</h6>
                                        </div>
                                        <div class="col">
                                            <h6 class="ms-5">{{ Auth::user()->name }}</h6>
                                        </div>
                                    </div>
                                    <div class="d-flex mt-3">
                                        <div class="col-2">
                                            <h6 class="fw-bold">Email:</h6>
                                        </div>
                                        <div class="col">
                                            <h6 class="ms-5">{{ Auth::user()->email }}</h6>
                                        </div>
                                    </div>
                                    <div class="d-flex mt-3">
                                        <div class="col-2">
                                            <h6 class="fw-bold">Phone:</h6>
                                        </div>
                                        <div class="col">
                                            <h6 class="ms-5 @if (!Auth::user()->phone) text-danger fw-bold @endif">
                                                {{ Auth::user()->phone ? Auth::user()->phone : 'Please Update Your Information!' }}
                                            </h6>
                                        </div>
                                    </div>
                                    <div class="d-flex mt-3">
                                        <div class="col-2">
                                            <h6 class="fw-bold">Address:</h6>
                                        </div>
                                        <div class="col">
                                            <h6 class="ms-5 @if (!Auth::user()->address) text-danger fw-bold @endif">
                                                {{ Auth::user()->address ? Auth::user()->address : 'Please Update Your Information!' }}
                                            </h6>
                                        </div>

                                    </div>
                                    <div class="d-flex mt-3">
                                        <div class="col-2">
                                            <h6 class="fw-bold">Role:</h6>
                                        </div>
                                        <div class="col">
                                            <h6
                                                class="ms-5 fw-bold @if (Auth::user()->role == 'admin') text-success

                                                @else
                                                    text-primary @endif">
                                                {{ Auth::user()->role }}
                                            </h6>
                                        </div>
                                    </div>

                                    <div class="d-flex mt-3">
                                        <div class="col-4">
                                            <a href="{{ route('admin#profile#updatePage') }}" class="btn btn-primary">Update
                                                Profile</a>
                                        </div>
                                        <div class="col">
                                            <a href="{{ route('admin#profile#changePasswordPage') }}"
                                                class="btn btn-success">Change Password</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

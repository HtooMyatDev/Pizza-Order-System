@extends('admin.layouts.master')
@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Admin Profile</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Add New Admin</li>
            </ol>

            <div class="row">
                <div class="col-4 offset-4">
                    <form action="{{route('admin#add#account')}}" method="post">
                        @csrf
                        <div class="card">
                            <div class="card-header bg-primary"></div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <h6 class="fw-bold">Name</h6>
                                    <input type="text" name="name"
                                        class="form-control @error('name')
                                    is-invalid
                                @enderror"
                                        placeholder="Enter Name..." value="{{ old('name') }}">
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <hr>

                                <div class="mb-3">
                                    <h6 class="fw-bold">Email Address</h6>
                                    <input type="text" name="email"
                                        class="form-control @error('email')
                                    is-invalid
                                @enderror"
                                        placeholder="Enter Email address..." value="{{ old('email') }}">
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <hr>

                                <div class="mb-3">
                                    <h6 class="fw-bold">Password</h6>
                                    <input type="text" name="password"
                                        class="form-control @error('password')
                                    is-invalid
                                @enderror"
                                        placeholder="Enter Password...">
                                    @error('password')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <hr>

                                <div class="mb-3">
                                    <h6 class="fw-bold">Confirm Password</h6>
                                    <input type="text" name="confirmPassword"
                                        class="form-control @error('confirmPassword')
                                    is-invalid
                                @enderror"
                                        placeholder="Enter Confirm Password...">
                                    @error('confirmPassword')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>


                                <div class="mb-3">
                                    <input type="submit" value="Add Admin" class="btn btn-primary fw-bold">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

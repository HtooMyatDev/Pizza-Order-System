@extends('admin.layouts.master')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Admin Profile</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Change Password</li>
            </ol>

            <div class="row">
                <div class="col-6 offset-3">
                    <div class="card">
                        <div class="card-header bg-primary"></div>
                        <div class="card-body">
                            <form action="{{ route('admin#profile#changePassword') }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <h6 class="fw-bold">Current Password</h6>
                                    <input type="text" name="currentPassword" class="form-control"
                                        placeholder="Enter current password...">

                                    @if (Session('Wrong'))
                                        <small class="text-danger">{{ session('error') }}</small>
                                    @endif
                                    @error('currentPassword')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <h6 class="fw-bold">New Password</h6>
                                            <input type="text" name="newPassword" class="form-control"
                                                placeholder="Enter new password...">
                                            @error('newPassword')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-3">
                                            <h6 class="fw-bold">Confirm Password</h6>
                                            <input type="text" name="confirmPassword" class="form-control"
                                                placeholder="Confirm password...">
                                            @error('confirmPassword')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="mb-3 ">
                                        <input type="submit" value="Change Password" class="btn btn-primary w-100 fw-bold">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

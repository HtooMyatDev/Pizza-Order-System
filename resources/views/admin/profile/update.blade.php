@extends('admin.layouts.master')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Admin Profile</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Admin Profile Edit</li>
            </ol>

            <div class="row">
                <div class="col-6 offset-3">
                    <div class="card">
                        <div class="card-header bg-primary"></div>
                        <div class="card-body">
                            <form action="{{ route('admin#profile#update') }}" method="post" enctype="multipart form-data">
                                @csrf
                                <div class="row mb-3 justify-content-center align-items-center">
                                    <div class="col-4">
                                        <img src="{{ old('profile', asset(Auth::user()->profile == null ? 'admin/img/default.jpg' : 'profile/' . Auth::user()->profile)) }}"
                                            class="img-thumbnail img-fluid border rounded"
                                            style="height:200px; width:200px; object-fit: cover" id="output">
                                    </div>
                                    {{-- profile --}}
                                    <div class="col">
                                        <input type="file" name="profile" class="form-control"
                                            onchange="loadFile(event)">

                                        @error('profile')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror

                                    </div>
                                    {{-- </profile --}}
                                </div>

                                {{-- name --}}
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" placeholder="name.."
                                        value="{{ old('name', Auth::user()->name) }}" name='name'>
                                    <label for="floatingInput">Name</label>

                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror

                                </div>
                                {{-- </name --}}

                                {{-- email --}}
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="floatingPassword"
                                        placeholder="name@example.com" value="{{ old('email', Auth::user()->email) }}"
                                        name='email'>
                                    <label for="floatingPassword">Email address</label>

                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                {{-- </email --}}

                                {{-- phone --}}
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput"
                                        placeholder="+95 957758981" value="{{ old('phone', Auth::user()->phone) }}"
                                        name='phone'>
                                    <label for="floatingInput">Phone number</label>

                                    @error('phone')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                {{-- </phone --}}

                                {{-- </address --}}
                                <div class="form-floating mb-3">
                                    <div class="form-floating">

                                        <textarea class="form-control" placeholder="Leave smth here" id="floatingTextarea2" style="height: 100px"
                                            name="address">{{ old('address', Auth::user()->address) }}</textarea>
                                        <label for="floatingTextarea2">Address</label>

                                        @error('address')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror

                                    </div>
                                </div>
                                {{-- </address --}}

                                <div class="mb-3">
                                    <a href="{{ route('admin#profile#changePasswordPage') }}" target="_blank"
                                        rel="noopener noreferrer" class="fw-bold text-dark">
                                        Change Password
                                    </a>
                                </div>
                                <div class="mb-3 row px-3">
                                    <input type="submit" value="Update Profile" class="btn btn-primary">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

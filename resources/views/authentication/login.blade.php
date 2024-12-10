@extends('authentication.layouts.master')

@section('content')
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4 text-primary fw-bold">Login</h3>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputEmail" type="email"
                                                placeholder="name@example.com" name="email" value="{{ old('email') }}" />
                                            <label for="inputEmail">Email address</label>
                                            @error('email')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputPassword" type="password"
                                                placeholder="Password" name="password" />
                                            <label for="inputPassword">Password</label>
                                            @error('password')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="row mb-3 px-3">
                                            <a href="/auth/google/redirect" class="btn btn-outline-primary fw-bold">
                                                <i class="fa-brands fa-google"></i> Continue with Google</a>
                                        </div>
                                        <div class="row mb-3 px-3">
                                            <a href="/auth/github/redirect" class="btn btn-outline-dark fw-bold">
                                                <i class="fa-brands fa-github"></i> Continue with Github</a>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" id="inputRememberPassword" type="checkbox"
                                                value="" />
                                            <label class="form-check-label" for="inputRememberPassword">Remember
                                                Password</label>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0 fw-bold">
                                            <a href="password.html" class="text-decoration-none small">Forgot
                                                Password?</a>
                                            <input type="submit" class="btn btn-primary fw-bold" value="Login">
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3 fw-bold">
                                    <div class="small"><a href="{{ route('register') }}" class="text-decoration-none">Need
                                            an account? Sign up!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection

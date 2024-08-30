@extends('front.layouts.app')

@section('content')
    <section class="section-5">
        <div class="container my-3">
            <div class="py-lg-1">&nbsp;</div>
            {{-- message --}}
           @include('sweetalert::alert')
            <div class="row d-flex justify-content-center">
                <div class="col-md-5">
                    <div class="card shadow border-0 p-3">
                        <h1 class="h3 text-center">Login</h1>
                        <form action="{{ route('account.authenticate') }}" method="post">
                            @csrf
                            {{-- email --}}
                            <div class="mb-3">
                                <label for="" class="mb-2">Email*</label>
                                <input type="text" value="{{ old('email') }}" name="email" id="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    placeholder="example@example.com">
                                {{-- message --}}
                                @error('email')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            {{-- password --}}
                            <div class="mb-3">
                                <label for="" class="mb-2">Password*</label>
                                <input type="password" name="password" id="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Enter Password">
                                {{-- message --}}
                                @error('password')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="justify-content-between d-flex">
                                <button class="btn btn-primary mt-2">Login</button>
                                <a href="forgot-password.html" class="mt-3">Forgot Password?</a>
                            </div>
                        </form>
                        <div class="mt-4 text-center">
                            <p>Do not have an account? <a href="{{ route('account.registration') }}">Register</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="py-lg-5">&nbsp;</div>
        </div>
    </section>
@endsection

@extends('front.layouts.app')

@section('content')
    <section class="section-5">
        <div class="container my-3">
            <div class="py-lg-1">&nbsp;</div>
            <div class="row d-flex justify-content-center">
                <div class="col-md-6">
                    <div class="card shadow border-0 p-3">
                        <h1 class="h3 text-center">Account Register</h1>
                        <form action="{{ route('account.processReg') }}" method="post">
                            @csrf
                            {{-- name --}}
                            <div class="mb-3">
                                <label for="" class="mb-2">Name*</label>
                                <input type="text" name="name" id="name"
                                    class="form-control @error('name') is-invalid @enderror" placeholder="Enter Name">
                                {{-- message --}}
                                @error('name')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            {{-- email --}}
                            <div class="mb-3">
                                <label for="" class="mb-2">Email*</label>
                                <input type="text" name="email" id="email"
                                    class="form-control @error('email') is-invalid @enderror" placeholder="Enter Email">
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
                            {{-- confirm_password --}}
                            <div class="mb-3">
                                <label for="" class="mb-2">Confirm Password*</label>
                                <input type="password" name="confirm_password" id="confirm_password"
                                    class="form-control @error('confirm_password') is-invalid @enderror"
                                    placeholder="Enter confirm Password">
                                {{-- message --}}
                                @error('confirm_password')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <button class="btn btn-primary mt-2">Register</button>
                        </form>
                        <div class="mt-4 text-center">
                            <p>Have an account? <a href="{{ route('account.login') }}">Login</a></p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection

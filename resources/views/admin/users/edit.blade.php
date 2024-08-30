@extends('front.layouts.app')

@section('content')
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.users')}}">Users</a></li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                @include('admin.sidebar')
                <div class="col-lg-9">
                    <div class="card border-0 shadow mb-4">
                        <div class="card-body card-form">
                            <form action="{{route('admin.userupdate',$user->id)}}" method="POST">
                                @csrf
                                <div class="card-body p-4">
                                    <h3 class="fs-4 mb-1">Edit User</h3>
                                    <div class="mb-4">
                                        <label for="" class="mb-2">Name</label>
                                        <input type="text" name="name" id="name" class="form-control" value="{{$user->name}}">
                                    </div>

                                    <div class="mb-4">
                                        <label for="" class="mb-2">Email</label>
                                        <input type="text" name="email" id="email" class="form-control" value="{{$user->email}}">
                                    </div>

                                    <div class="mb-4">
                                        <label for="" class="mb-2">Phone Number</label>
                                        <input type="text" name="mobile" id="mobile" class="form-control" value="{{$user->mobile}}">
                                    </div>
                                    <div class="mb-4">
                                        <label for="" class="mb-2">Designation</label>
                                        <input type="text" name="designation" id="mobile" class="form-control" value="{{$user->designation}}">
                                    </div>
                                </div>
                                <div class="card-footer p-4">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

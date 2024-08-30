@extends('front.layouts.app')

@section('content')
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Job Applications</li>
                        </ol>
                    </nav>
                </div>
            </div>
            @include('sweetalert::alert')
            <div class="row">
                @include('admin.sidebar')
                <div class="col-lg-9">
                    <div class="card border-0 shadow mb-4">
                        <div class="card-body card-form">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3 class="fs-4 mb-1">Job Applications</h3>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="bg-light">
                                        <tr>
                                            <th scope="col">Job title</th>
                                            <th scope="col">User</th>
                                            <th scope="col">Employer</th>
                                            <th scope="col">Applied Date</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="border-0">
                                        @if ($applications->isNotEmpty())
                                            @foreach ($applications as $apply)
                                                <tr class="active">
                                                    <td>{{$apply->job->title}}</td>
                                                    <td>{{$apply->user->name}}</td>
                                                    <td>{{$apply->employer->name}}</td>
                                                    <td>{{\Carbon\Carbon::parse($apply->applied_date)->format('d M,Y')}}</td>

                                                    <td>
                                                        <div class="action-dots">
                                                            <button href="#" class="btn"
                                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                            </button>

                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                {{-- <li><a class="dropdown-item" href="#"> <i
                                                                            class="fa fa-eye" aria-hidden="true"></i>
                                                                        View</a></li> --}}

                                                                {{-- <li><a class="dropdown-item"

                                                                        href="{{route('admin.useredit',$apply->id)}}"><i
                                                                            class="fa fa-edit" aria-hidden="true"></i>
                                                                        Edit</a></li> --}}
                                                                <li>
                                                                    {{--  --}}
                                                                    <form action="{{route('admin.application-delete',$apply->id)}}" method="POST">
                                                                        @csrf
                                                                        <button type="submit" class="dropdown-item"
                                                                            onclick="return confirm('Are you sure you want to delete this Applied Job?')"><i
                                                                                class="fa fa-trash"
                                                                                aria-hidden="true"></i> Remove
                                                                        </button>
                                                                    </form>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            {{-- paginet link --}}
                            <div>
                                {{ $applications->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

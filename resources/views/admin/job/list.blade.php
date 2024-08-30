@extends('front.layouts.app')

@section('content')
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Jobs</li>
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
                                    <h3 class="fs-4 mb-1">All Jobs</h3>
                                </div>

                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="bg-light">
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Create By</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="border-0">
                                        @if ($jobs->isNotEmpty())
                                            @foreach ($jobs as $job)
                                                <tr class="active">
                                                    <td>{{$job->id}}</td>
                                                    <td>{{$job->title}}
                                                        <p>Applicants: {{$job->applications->count()}}</p>
                                                    </td>
                                                    <td>{{$job->user->name}}</td>
                                                    <td>
                                                        @if ($job->status == 1)
                                                            <p class="text-success">Active</p>
                                                        @else
                                                        <p class="text-danger">Block</p>
                                                        @endif
                                                    </td>
                                                    <td>{{\Carbon\Carbon::parse($job->created_at)->format('d M,Y')}}</td>

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
                                                                <li><a class="dropdown-item"
                                                                        href="{{route('admin.jobs-edit',$job->id)}}"><i
                                                                            class="fa fa-edit" aria-hidden="true"></i>
                                                                        Edit</a></li>
                                                                <li>
                                                                    <form action="{{route('admin.jobs-delete',$job->id)}}" method="POST">
                                                                        @csrf
                                                                        <button type="submit" class="dropdown-item"
                                                                            onclick="return confirm('Are you sure you want to delete this Job?')"><i
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
                                {{ $jobs->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

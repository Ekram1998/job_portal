@extends('front.layouts.app')

@section('content')
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="row">
                    <div class="col">
                        <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Jobs Applied</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                @include('sweetalert::alert')
                <div class="row">
                    @include('front.account.sidebarMy')
                    <div class="col-lg-9">
                        <div class="card border-0 shadow mb-4 p-3">
                            <div class="card-body card-form">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h3 class="fs-4 mb-1">Jobs Applied</h3>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="bg-light">
                                            <tr>
                                                <th scope="col">Title</th>
                                                <th scope="col">Applied Date</th>
                                                <th scope="col">Applicants</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="border-0">
                                            @if ($jobApplications->isNotEmpty())
                                                @foreach ($jobApplications as $jobApplication)
                                                    <tr class="active">
                                                        <td>
                                                            <div class="job-name fw-500">{{ $jobApplication->job->title }}
                                                            </div>
                                                            <div class="info1">{{ $jobApplication->job->job_type->name }} .
                                                                {{ $jobApplication->job->location }}</div>
                                                        </td>
                                                        <td>{{ \Carbon\Carbon::parse($jobApplication->job->create_at)->format('d M, Y') }}
                                                        </td>
                                                        <td>{{$jobApplication->job->applications->count()}}  Applications</td>
                                                        <td>
                                                            @if ($jobApplication->job->status == 1)
                                                                <div class="job-status text-capitalize">active</div>
                                                            @else
                                                                <div class="job-status text-capitalize">Block</div>
                                                            @endif

                                                        </td>
                                                        <td>
                                                            <div class="action-dots float-end">
                                                                <button href="#" class="btn"
                                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                                </button>
                                                                <ul class="dropdown-menu dropdown-menu-end">
                                                                    <li><a class="dropdown-item"
                                                                            href="{{ route('job.jobdetail', $jobApplication->job->id) }}">
                                                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                                                            View</a></li>

                                                                    {{-- Remove --}}
                                                                    <li>
                                                                        <form
                                                                            action="{{ route('job.removeappliedjob', $jobApplication->id) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            <button type="submit" class="dropdown-item"
                                                                                onclick="return confirm('Are you sure you want to delete this Job?')">
                                                                                <i class="fa fa-trash"
                                                                                    aria-hidden="true"></i> Remove
                                                                            </button>
                                                                        </form>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                @else
                                                <tr>
                                                    <td colspan="5">Job Application Not Found</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                                {{-- paginet link --}}
                                <div>
                                    {{ $jobApplications->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </section>
@endsection

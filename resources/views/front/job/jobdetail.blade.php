@extends('front.layouts.app')

@section('content')
    <section class="section-4 bg-2">
        <div class="container pt-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class=" rounded-3 p-3">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('job.findjobs') }}"><i class="fa fa-arrow-left"
                                        aria-hidden="true"></i> &nbsp;Back to Jobs</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        {{-- alert massage --}}
        @include('sweetalert::alert')
        <div class="container job_details_area">
            <div class="row pb-5">
                <div class="col-md-8">
                    <div class="card shadow border-0">
                        <div class="job_details_header">
                            <div class="single_jobs white-bg d-flex justify-content-between">
                                <div class="jobs_left d-flex align-items-center">

                                    <div class="jobs_conetent">
                                        <a href="#">
                                            <h4>{{ $job->title }}</h4>
                                        </a>
                                        <div class="links_locat d-flex align-items-center">
                                            <div class="location">
                                                <p> <i class="fa fa-map-marker"></i> {{ $job->location }}</p>
                                            </div>
                                            <div class="location">
                                                <p> <i class="fa fa-clock-o"></i> {{ $job->job_type->name }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="jobs_right">

                                    <div class="apply_now">
                                        @if (Auth::check())
                                            <form action="{{ route('job.saved') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $job->id }}">
                                                <button type="submit" class="btn btn-secondary">Save</button>
                                            </form>
                                        @else
                                            <a href="{{ route('account.login') }}" class="btn btn-secondary">Login to
                                                Save</a>
                                        @endif
                                        {{-- <a class="heart_mark" href="#"> <i class="fa fa-heart-o"
                                            aria-hidden="true"></i></a> --}}
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="descript_wrap white-bg">
                            {{-- job description --}}
                            @if (!empty($job->description))
                                <div class="single_wrap">
                                    <h4>Job Description</h4>
                                    <p></p>{!! nl2br($job->description) !!}
                                </div>
                            @endif
                            {{-- job responsiblity --}}
                            @if (!empty($job->responsiblity))
                                <div class="single_wrap">
                                    <h4>Job Responsiblity</h4>
                                    <p></p>{!! nl2br($job->responsiblity) !!}
                                </div>
                            @endif
                            {{-- job qualification  --}}
                            @if (!empty($job->qualification))
                                <div class="single_wrap">
                                    <h4>Job Qualification</h4>
                                    <p></p>{!! nl2br($job->qualification) !!}
                                </div>
                            @endif
                            {{-- benefits --}}
                            @if (!empty($job->benefits))
                                <div class="single_wrap">
                                    <h4>Job Benefits</h4>
                                    <p></p>{!! nl2br($job->benefits) !!}
                                </div>
                            @endif

                            <div class="border-bottom"></div>
                            <br>
                            <div class="pt-3 text-end">
                                {{-- <div class="row g-3"> --}}
                                {{-- job Saved --}}
                                {{-- <div class="col">
                                    @if (Auth::check())
                                        <form action="{{ route('job.saved') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $job->id }}">
                                            <button type="submit" class="btn btn-secondary">Save</button>
                                        </form>
                                    @else
                                        <a href="{{ route('account.login') }}" class="btn btn-secondary">Login to Save</a>
                                    @endif
                                </div> --}}

                                {{-- Apply Button --}}
                                @if (Auth::check())
                                    <form action="{{ route('job.applyjob') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $job->id }}">
                                        <button type="submit" class="btn btn-primary">Apply</button>
                                    </form>
                                @else
                                    <a href="{{ route('account.login') }}" class="btn btn-primary">Login to Apply</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <br>
                    {{-- Applicant Info --}}
                    <div class="card shadow border-0">
                        @if (Auth::user())
                            @if (Auth::user()->id == $job->user_id)
                                <div class="job_details_header">
                                    <div class="single_jobs white-bg d-flex justify-content-between">
                                        <div class="jobs_lest d-flex align-items-center">
                                            <div class="jobs_content">
                                                <h4>Applicants</h4>
                                            </div>
                                        </div>
                                        <div class="jobs_right"></div>
                                    </div>
                                    <div class="descript_wrap white-bg">
                                        <table class="table table-striped">
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Mobile</th>
                                                <th>Applied Date</th>
                                            </tr>
                                            @if ($applications->isNotEmpty())
                                                @foreach ($applications as $application)
                                                    <tr>
                                                        <td>{{ $application->user->name }}</td>
                                                        <td>{{ $application->user->email }}</td>
                                                        <td>{{ $application->user->mobile }}</td>
                                                        <td>
                                                            {{ \Carbon\Carbon::parse($application->applied_date)->format('d M,Y') }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="3">Applicants not found</td>
                                                </tr>
                                            @endif
                                        </table>
                                    </div>
                                </div>
                            @endif
                        @endif
                    </div>
                    {{-- Applicant Info --}}
                </div>
                <div class="col-md-4">
                    <div class="card shadow border-0">
                        <div class="job_sumary">
                            <div class="summery_header pb-1 pt-4">
                                <h3>Job Summery</h3>
                            </div>
                            <div class="job_content pt-3">
                                <ul>
                                    <li>Published on:
                                        <span>{{ \Carbon\Carbon::parse($job->created_at)->format('d, M Y') }}</span>
                                    </li>

                                    @if (!empty($job->vacancy))
                                        <li>Vacancy: <span> {{ $job->vacancy }}</span></li>
                                    @endif

                                    @if (!empty($job->salary))
                                        <li>Salary: <span> {{ $job->salary }}</span></li>
                                    @endif

                                    @if (!empty($job->location))
                                        <li>Location: <span> {{ $job->location }}</span></li>
                                    @endif

                                    @if (!empty($job->job_type->name))
                                        <li>Job Nature: <span> {{ $job->job_type->name }}</span></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow border-0 my-4">
                        <div class="job_sumary">
                            <div class="summery_header pb-1 pt-4">
                                <h3>Company Details</h3>
                            </div>
                            <div class="job_content pt-3">
                                <ul>
                                    @if (!empty($job->company_name))
                                        <li>Name: <span> {{ $job->company_name }}</span></li>
                                    @endif

                                    @if (!empty($job->company_location))
                                        <li>Locaion: <span>{{ $job->company_location }}</span></li>
                                    @endif

                                    @if (!empty($job->company_website))
                                        <li>Webite: <span><a href="#">{{ $job->company_website }}</a></span></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

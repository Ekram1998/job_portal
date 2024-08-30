@extends('front.layouts.app')
@section('content')
    <section class="section-0 lazy d-flex bg-image-style dark align-items-center " class=""
        data-bg="assets/images/banner5.jpg">
        <div class="container">
            <div class="row">
                {{-- col-xl-8 --}}
                <div class="col-12 col-xl-9">
                    {{-- <h1>Find your dream job</h1>
                    <p>Thounsands of jobs available.</p> --}}
                    <h1>আপনার স্বপ্নের চাকরি খুঁজুন</h1>
                    <p>হাজার হাজার চাকরি পাওয়া যায়।</p>
                    <div class="banner-btn mt-5"><a href="#" class="btn btn-primary mb-4 mb-sm-0">Explore Now</a></div>
                </div>
            </div>
        </div>
    </section>

    {{-- search bar --}}
    <section class="section-1 py-5 ">
        <div class="container">
            <div class="card border-0 shadow p-5">
                <form action="{{route('job.findjobs')}}" method="GET">
                    <div class="row">
                        <div class="col-md-3 mb-3 mb-sm-3 mb-lg-0">
                            <input type="text" class="form-control" name="keyword" id="keyword" placeholder="Keywords">
                        </div>
                        <div class="col-md-3 mb-3 mb-sm-3 mb-lg-0">
                            <input type="text" class="form-control" name="location" id="location"
                                placeholder="Location">
                        </div>
                        <div class="col-md-3 mb-3 mb-sm-3 mb-lg-0">
                            <select name="category" id="category" class="form-control">
                                <option value="">Select a Category</option>
                                @if ($newcategories->isNotEmpty())
                                    @foreach ($newcategories as $catagoryselect)
                                        <option value="{{ $catagoryselect->id }}">{{ $catagoryselect->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class=" col-md-3 mb-xs-3 mb-sm-3 mb-lg-0">
                            <div class="d-grid gap-2">
                                {{-- <a href="jobs.html" class="btn btn-primary btn-block">Search</a> --}}
                                <button type="submit" class="btn btn-primary btn-block">Search</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <section class="section-2 bg-2 py-5">
        <div class="container">
            <h2>Popular Categories</h2>
            <div class="row pt-5">
                @if ($categories->isNotEmpty())
                    @foreach ($categories as $category)
                        <div class="col-lg-4 col-xl-3 col-md-6">
                            <div class="single_catagory">
                                <a href="{{route('job.findjobs').'?category='.$category->id }}">
                                    <h4 class="pb-2">{{ $category->name }}</h4>
                                </a>
                                <p class="mb-0"> <span>0</span> Available position</p>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>

    <section class="section-3  py-5">
        <div class="container">
            <h2>Featured Jobs</h2>
            <div class="row pt-5">
                <div class="job_listing_area">
                    <div class="job_lists">
                        <div class="row">
                            @if ($featureJobs->isNotEmpty())
                                @foreach ($featureJobs as $fecherjob)
                                    <div class="col-md-4">
                                        <div class="card border-0 p-3 shadow mb-4">
                                            <div class="card-body">
                                                <h3 class="border-0 fs-5 pb-2 mb-0">{{ $fecherjob->title }}</h3>
                                                <p>{{ Str::words($fecherjob->description, 5) }}</p>
                                                <div class="bg-light p-3 border">
                                                    <p class="mb-0">
                                                        <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                                        <span class="ps-1">{{ $fecherjob->location }}</span>
                                                    </p>
                                                    <p class="mb-0">
                                                        <span class="fw-bolder"><i class="fa fa-clock-o"></i></span>
                                                        <span class="ps-1">{{ $fecherjob->job_type->name }}</span>
                                                    </p>
                                                    @if (!is_null($fecherjob->salary))
                                                        <p class="mb-0">
                                                            <span class="fw-bolder"><i class="fa fa-usd"></i></span>
                                                            <span class="ps-1">{{ $fecherjob->salary }}</span>
                                                        </p>
                                                    @endif

                                                </div>
                                                <div class="d-grid mt-3">
                                                    <a href="{{ route('job.jobdetail', $fecherjob->id) }}"
                                                        class="btn btn-primary btn-lg">Details</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-3 bg-2 py-5">
        <div class="container">
            <h2>Latest Jobs</h2>
            <div class="row pt-5">
                <div class="job_listing_area">
                    <div class="job_lists">
                        <div class="row">
                            @if ($latestJobs->isNotEmpty())
                                @foreach ($latestJobs as $latejob)
                                    <div class="col-md-4">
                                        <div class="card border-0 p-3 shadow mb-4">
                                            <div class="card-body">
                                                <h3 class="border-0 fs-5 pb-2 mb-0">{{ $latejob->title }}</h3>
                                                <p>{{ Str::words($latejob->description, 5) }}</p>
                                                <div class="bg-light p-3 border">
                                                    <p class="mb-0">
                                                        <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                                        <span class="ps-1">{{ $latejob->location }}</span>
                                                    </p>
                                                    <p class="mb-0">
                                                        <span class="fw-bolder"><i class="fa fa-clock-o"></i></span>
                                                        <span class="ps-1">{{ $latejob->job_type->name }}</span>
                                                    </p>
                                                    @if (!is_null($latejob->salary))
                                                        <p class="mb-0">
                                                            <span class="fw-bolder"><i class="fa fa-usd"></i></span>
                                                            <span class="ps-1">{{ $latejob->salary }}</span>
                                                        </p>
                                                    @endif
                                                </div>

                                                <div class="d-grid mt-3">
                                                    <a href="{{ route('job.jobdetail', $latejob->id) }}"
                                                        class="btn btn-primary btn-lg">Details</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

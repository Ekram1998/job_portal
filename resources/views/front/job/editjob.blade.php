@extends('front.layouts.app')

@section('content')
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Edit Job</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                {{-- sidebar include --}}
                @include('front.account.sidebarMy')

                <div class="col-lg-9">
                    <div class="card border-0 shadow mb-4 ">
                        <form action="{{route('job.updateJob', $job->id)}}" method="post">
                            @csrf
                            <div class="card-body card-form p-4">
                                <h3 class="fs-4 mb-1">Job Details</h3>
                                <div class="row">
                                    {{-- title --}}
                                    <div class="col-md-6 mb-4">
                                        <label for="" class="mb-2">Title<span class="req">*</span></label>
                                        <input type="text" value="{{$job->title}}" id="title" name="title"
                                            class="form-control">
                                    </div>
                                    {{-- category --}}
                                    <div class="col-md-6  mb-4">
                                        <label for="" class="mb-2">Category<span class="req">*</span></label>
                                        <select name="category_id" id="category" class="form-control">

                                            @if ($Categories->isNotEmpty())
                                                @foreach ($Categories as $category)
                                                    <option {{($job->category_id == $category->id) ? 'selected' : ''}} value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    {{-- job nature --}}
                                    <div class="col-md-6 mb-4">
                                        <label for="" class="mb-2">Job Nature<span class="req">*</span></label>
                                        <select name="job_type_id" class="form-select">
                                            <option value="">Select Job Nature</option>
                                            @if ($job_type->isNotEmpty())
                                                @foreach ($job_type as $jobs)
                                                    <option {{($job->job_type_id == $jobs->id) ? 'selected' : ''}} value="{{ $jobs->id }}">{{ $jobs->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    {{-- vacancy --}}
                                    <div class="col-md-6  mb-4">
                                        <label for="" class="mb-2">Vacancy<span class="req">*</span></label>
                                        <input type="number" min="1" value="{{$job->vacancy}}" id="vacancy"
                                            name="vacancy" class="form-control">
                                    </div>
                                </div>

                                <div class="row">
                                    {{-- salary --}}
                                    <div class="mb-4 col-md-6">
                                        <label for="" class="mb-2">Salary</label>
                                        <input type="text" placeholder="{{$job->salary}}" id="salary" name="salary"
                                            class="form-control">
                                    </div>
                                    {{-- location --}}
                                    <div class="mb-4 col-md-6">
                                        <label for="" class="mb-2">Location<span class="req">*</span></label>
                                        <input type="text" value="{{$job->location}}" id="location" name="location"
                                            class="form-control">
                                    </div>
                                </div>
                                {{-- description --}}
                                <div class="mb-4">
                                    <label for="" class="mb-2">Description<span class="req">*</span></label>
                                    <textarea class="textarea" name="description" id="description" cols="5" rows="5"
                                        value="{{$job->description}}">{{$job->description}}</textarea>
                                </div>
                                {{-- benefits --}}
                                <div class="mb-4">
                                    <label for="" class="mb-2">Benefits</label>
                                    <textarea class="textarea" name="benefits" id="benefits" cols="5" rows="5" value="{{$job->benefits}}">{{$job->benefits}}</textarea>
                                </div>
                                {{-- responsiblity --}}
                                <div class="mb-4">
                                    <label for="" class="mb-2">Responsibility</label>
                                    <textarea class="textarea" name="responsiblity" id="responsibility" cols="5" rows="5"
                                        value="{{$job->responsiblity}}">{{$job->responsiblity}}</textarea>
                                </div>
                                {{-- qualification --}}
                                <div class="mb-4">
                                    <label for="" class="mb-2">Qualifications</label>
                                    <textarea class="textarea" name="qualification" id="qualifications" cols="5" rows="5"
                                        value="{{$job->qualification}}">{{$job->qualification}}</textarea>
                                </div>
                                {{-- keywords --}}
                                <div class="mb-4">
                                    <label for="" class="mb-2">Keywords</label>
                                    <input type="text" value="{{$job->keywords}}" id="keywords" name="keywords"
                                        class="form-control">
                                </div>
                                {{-- experience --}}
                                <div class="mb-4">
                                    <label for="" class="mb-2">Experience<span class="req">*</span></label>
                                    <select name="experience" id="" class="form-select">
                                        <option value="">Your Experience Selecte</option>
                                        <option value="0" {{($job->experience == 0) ? 'selected':''}}>Fresher</option>
                                        <option value="1" {{($job->experience == 1) ? 'selected':''}}>1 Years</option>
                                        <option value="2" {{($job->experience == 2) ? 'selected':''}}>2 Years</option>
                                        <option value="3" {{($job->experience == 3) ? 'selected':''}}>3 Years</option>
                                        <option value="4" {{($job->experience == 4) ? 'selected':''}}>4 Years</option>
                                        <option value="5" {{($job->experience == 5) ? 'selected':''}}>5 Years</option>
                                        <option value="6" {{($job->experience == 6) ? 'selected':''}}>6 Years</option>
                                        <option value="7" {{($job->experience == 7) ? 'selected':''}}>7 Years</option>
                                        <option value="8" {{($job->experience == 8) ? 'selected':''}}>8 Years</option>
                                        <option value="9" {{($job->experience == 9) ? 'selected':''}}>9 Years</option>
                                        <option value="10" {{($job->experience == 10) ? 'selected':''}}>10 Years</option>
                                        <option value="11" {{($job->experience == 11) ? 'selected':''}}>10+ Years</option>
                                    </select>

                                    <h3 class="fs-4 mb-1 mt-5 border-top pt-5">Company Details</h3>

                                    <div class="row">
                                        <div class="mb-4 col-md-6">
                                            <label for="" class="mb-2">Name<span
                                                    class="req">*</span></label>
                                            <input type="text" value="{{$job->company_name}}" id="company_name"
                                                name="company_name" class="form-control">
                                        </div>

                                        <div class="mb-4 col-md-6">
                                            <label for="" class="mb-2">Location</label>
                                            <input type="text" value="{{$job->company_location}}" id="location"
                                                name="company_location" class="form-control">
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label for="" class="mb-2">Website</label>
                                        <input type="text" value="{{$job->company_website}}" id="website"
                                            name="company_website" class="form-control">
                                    </div>
                                </div>
                                <div class="card-footer  p-4">
                                    <button type="submit" class="btn btn-primary">Update Job</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection

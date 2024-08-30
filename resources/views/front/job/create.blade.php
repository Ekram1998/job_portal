@extends('front.layouts.app')

@section('content')
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Post a Job</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                {{-- sidebar include --}}
                @include('front.account.sidebarMy')

                <div class="col-lg-9">
                    <div class="card border-0 shadow mb-4 ">
                        <form action="{{route('job.storeJob')}}" method="post">
                            @csrf
                            <div class="card-body card-form p-4">
                                <h3 class="fs-4 mb-1">Job Details</h3>
                                <div class="row">
                                    {{-- title --}}
                                    <div class="col-md-6 mb-4">
                                        <label for="" class="mb-2">Title<span class="req">*</span></label>
                                        <input type="text" placeholder="Job Title" id="title" name="title"
                                            class="form-control">
                                    </div>
                                    {{-- category --}}
                                    <div class="col-md-6  mb-4">
                                        <label for="" class="mb-2">Category<span class="req">*</span></label>
                                        <select name="category_id" id="category" class="form-control">
                                            <option value="">Select a Category</option>
                                            @if ($Categories->isNotEmpty())
                                                @foreach ($Categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
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
                                                @foreach ($job_type as $job)
                                                    <option value="{{ $job->id }}">{{ $job->name }}</option>
                                                @endforeach
                                            @endif
                                            {{-- <option>Full Time</option>
                                            <option>Part Time</option>
                                            <option>Remote</option>
                                            <option>Freelance</option> --}}
                                        </select>
                                    </div>
                                    {{-- vacancy --}}
                                    <div class="col-md-6  mb-4">
                                        <label for="" class="mb-2">Vacancy<span class="req">*</span></label>
                                        <input type="number" min="1" placeholder="Vacancy" id="vacancy"
                                            name="vacancy" class="form-control">
                                    </div>
                                </div>

                                <div class="row">
                                    {{-- salary --}}
                                    <div class="mb-4 col-md-6">
                                        <label for="" class="mb-2">Salary</label>
                                        <input type="text" placeholder="Salary" id="salary" name="salary"
                                            class="form-control">
                                    </div>
                                    {{-- location --}}
                                    <div class="mb-4 col-md-6">
                                        <label for="" class="mb-2">Location<span class="req">*</span></label>
                                        <input type="text" placeholder="location" id="location" name="location"
                                            class="form-control">
                                    </div>
                                </div>
                                {{-- description --}}
                                <div class="mb-4">
                                    <label for="" class="mb-2">Description<span class="req">*</span></label>
                                    <textarea class="textarea" name="description" id="description" cols="5" rows="5"
                                        placeholder="Description"></textarea>
                                </div>
                                {{-- benefits --}}
                                <div class="mb-4">
                                    <label for="" class="mb-2">Benefits</label>
                                    <textarea class="textarea" name="benefits" id="benefits" cols="5" rows="5" placeholder="Benefits"></textarea>
                                </div>
                                {{-- responsiblity --}}
                                <div class="mb-4">
                                    <label for="" class="mb-2">Responsibility</label>
                                    <textarea class="textarea" name="responsiblity" id="responsibility" cols="5" rows="5"
                                        placeholder="Responsibility"></textarea>
                                </div>
                                {{-- qualification --}}
                                <div class="mb-4">
                                    <label for="" class="mb-2">Qualifications</label>
                                    <textarea class="textarea" name="qualification" id="qualifications" cols="5" rows="5"
                                        placeholder="Qualifications"></textarea>
                                </div>
                                {{-- keywords --}}
                                <div class="mb-4">
                                    <label for="" class="mb-2">Keywords</label>
                                    <input type="text" placeholder="keywords" id="keywords" name="keywords"
                                        class="form-control">
                                </div>
                                {{-- experience --}}
                                <div class="mb-4">
                                    <label for="" class="mb-2">Experience<span class="req">*</span></label>
                                    <select name="experience" id="" class="form-select">
                                        <option value="">Your Experience Selecte</option>
                                        <option value="0">Fresher</option>
                                        <option value="1">1 Years</option>
                                        <option value="2">2 Years</option>
                                        <option value="3">3 Years</option>
                                        <option value="4">4 Years</option>
                                        <option value="5">5 Years</option>
                                        <option value="6">6 Years</option>
                                        <option value="7">7 Years</option>
                                        <option value="8">8 Years</option>
                                        <option value="9">9 Years</option>
                                        <option value="10">10 Years</option>
                                        <option value="10_plus">10+ Years</option>
                                    </select>

                                    <h3 class="fs-4 mb-1 mt-5 border-top pt-5">Company Details</h3>

                                    <div class="row">
                                        <div class="mb-4 col-md-6">
                                            <label for="" class="mb-2">Name<span
                                                    class="req">*</span></label>
                                            <input type="text" placeholder="Company Name" id="company_name"
                                                name="company_name" class="form-control">
                                        </div>

                                        <div class="mb-4 col-md-6">
                                            <label for="" class="mb-2">Location</label>
                                            <input type="text" placeholder="Location" id="location"
                                                name="company_location" class="form-control">
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label for="" class="mb-2">Website</label>
                                        <input type="text" placeholder="Website" id="website"
                                            name="company_website" class="form-control">
                                    </div>
                                </div>
                                <div class="card-footer  p-4">
                                    <button type="submit" class="btn btn-primary">Save Job</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection

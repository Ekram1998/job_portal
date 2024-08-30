<?php

namespace App\Http\Controllers;

use App\Mail\JobNotificationEmail;
use App\Models\Category;
use App\Models\Job;
use App\Models\User;
use App\Models\JobApplication;
use App\Models\JobType;
// use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;
use Alert;
use App\Models\SavedJob;
use Illuminate\Support\Facades\Mail;

class JobController extends Controller
{
    public function createJob()
    {
        $Categories = Category::orderBy('name', 'ASC')->where('status', 1)->get();
        $job_type = JobType::orderBy('name', 'ASC')->where('status', 1)->get();
        return view('front.job.create', ['Categories' => $Categories, 'job_type' => $job_type]);
    }

    public function storeJob(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'job_type_id' => 'required',
            'vacancy' => 'required',
            'salary' => '',
            'location' => 'required',
            'description' => 'required',
            'benefits' => '',
            'responsiblity' => '',
            'qualification' => '',
            'keywords' => '',
            'experience' => 'required',
            'company_name' => 'required',
            'company_location' => '',
            'company_website' => '',
        ]);
        $job = new Job();
        $job->title = $request->title;
        $job->category_id = $request->category_id;
        $job->job_type_id = $request->job_type_id;
        $job->user_id = Auth::user()->id;
        $job->vacancy = $request->vacancy;
        $job->salary = $request->salary;
        $job->location = $request->location;
        $job->description = $request->description;
        $job->benefits = $request->benefits;
        $job->responsiblity = $request->responsiblity;
        $job->qualification = $request->qualification;
        $job->keywords = $request->keywords;
        $job->experience = $request->experience;
        $job->company_name = $request->company_name;
        $job->company_location = $request->company_location;
        $job->company_website = $request->company_website;
        $job->save();

        Alert::success('success', 'New Job Post Created Successfully.');
        return redirect()->route('job.myjobs');
    }

    public function myjobs()
    {
        $jobs = Job::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->paginate(10);
        return view('front.job.myjobs', ['jobs' => $jobs]);
    }

    public function editjobs(Request $request, $id)
    {
        $categories = Category::orderBy('name', 'ASC')->where('status', 1)->get();
        $job_type = JobType::orderBy('name', 'ASC')->where('status', 1)->get();

        $job = Job::where(['user_id' => Auth::user()->id, 'id' => $id])->first();
        if ($job == null) {
            abort(404);
        }
        return view('front.job.editjob', [
            'Categories' => $categories,
            'job_type' => $job_type,
            'job' => $job,
        ]);
    }

    public function updateJob(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'job_type_id' => 'required',
            'vacancy' => 'required',
            'salary' => '',
            'location' => 'required',
            'description' => 'required',
            'benefits' => '',
            'responsiblity' => '',
            'qualification' => '',
            'keywords' => '',
            'experience' => 'required',
            'company_name' => 'required',
            'company_location' => '',
            'company_website' => '',
        ]);
        $job = Job::find($id);
        $job->title = $request->title;
        $job->category_id = $request->category_id;
        $job->job_type_id = $request->job_type_id;
        $job->user_id = Auth::user()->id;
        $job->vacancy = $request->vacancy;
        $job->salary = $request->salary;
        $job->location = $request->location;
        $job->description = $request->description;
        $job->benefits = $request->benefits;
        $job->responsiblity = $request->responsiblity;
        $job->qualification = $request->qualification;
        $job->keywords = $request->keywords;
        $job->experience = $request->experience;
        $job->company_name = $request->company_name;
        $job->company_location = $request->company_location;
        $job->company_website = $request->company_website;
        $job->save();
        Alert::success('Success', 'Job Updated Successfully.');
        return redirect()->route('job.myjobs');
    }

    // job destroy
    public function destroy($id)
    {
        $job = Job::find($id);
        $job->delete();
        Alert::info('Info', 'Job Deleted.');
        return redirect()->route('job.myjobs')->with('success', 'Job Deleted Successfully.');
    }

    // find job
    public function findjobs(Request $request)
    {
        $categories = Category::where('status', 1)->get();

        $jobTypes = JobType::where('status', 1)->get();

        $jobs = Job::where('status', 1);
        // Search using keyword
        if (!empty($request->keyword)) {
            $jobs = $jobs->where(function ($query) use ($request) {
                $query->orWhere('title', 'like', '%' . $request->keyword . '%');
                $query->orWhere('keywords', 'like', '%' . $request->keyword . '%');
            });
        }
        // search using location
        if (!empty($request->location)) {
            $jobs = $jobs->where('location', $request->location);
        }

        // search using category
        if (!empty($request->category)) {
            $jobs = $jobs->where('category_id', $request->category);
        }

        // search using job type
        $jobTypeArray = [];
        if (!empty($request->jobType)) {
            // 1,2,3
            $jobTypeArray = explode(',', $request->jobType);
            $jobs = $jobs->whereIn('job_type_id', $jobTypeArray);
        }

        // search using experience
        if (!empty($request->experience)) {
            $jobs = $jobs->where('experience', $request->experience);
        }

        // $jobs = $jobs->orderBy('created_at','DESC')->paginate(9);
        if ($request->sort == 0) {
            $jobs = $jobs->orderBy('created_at', 'ASC');
        } else {
            $jobs = $jobs->orderBy('created_at', 'DESC');
        }
        $jobs = $jobs->paginate(9);

        return view('front.job.findJob', [
            'categories' => $categories,
            'jobTypes' => $jobTypes,
            'jobs' => $jobs,
            'jobTypeArray' => $jobTypeArray,
        ]);
    }

    // job detail
    public function jobdetail($id)
    {
        $job = Job::where(['id' => $id, 'status' => 1])->first();
        if ($job == null) {
            abort(404);
        }
        $count = 0;
        if(Auth::user()){
            $count = SavedJob::where(['user_id'=>Auth::user()->id,'job_id'=>$id])->count();
        }
        // Fetch Applications
        $applications = JobApplication::where('job_id',$id)->with('user')->get();

        return view('front.job.jobdetail', [
            'job' => $job,
            'count'=>$count,
            'applications'=>$applications,
        ]);
    }

    // apply job
    public function applyjob(Request $request)
    {
        $id = $request->id;
        $job = Job::where('id', $id)->first();
        // if job not found in db
        if ($job == null) {
            Alert::info('error', 'Job dose not exist.');
            return redirect()->back();
        }

        // you can not apply on your own job
        $employer_id = $job->user_id;
        if ($employer_id == Auth::user()->id) {
            Alert::info('error', 'You can not apply your own project.');
            return redirect()->back();
        }

        // you can't apply on a job 2nd time
        $jobapplication = JobApplication::where(['user_id' => Auth::user()->id, 'job_id' => $id])->count();
        if ($jobapplication > 0) {
            Alert::info('error', 'Already Applied this job.');
            return redirect()->back();
        }

        // job Applied
        $application = new JobApplication();
        $application->job_id = $id;
        $application->user_id = Auth::user()->id;
        $application->employer_id = $employer_id;
        $application->applied_date = now();
        $application->save();

        // Send Notification Mail Who job provied
        $employer = User::where('id', $employer_id)->first();
        $emp_name = $employer->name;
        $emp_user_name = Auth::user()->name;
        $emp_user_email = Auth::user()->email;
        $emp_user_mobile = Auth::user()->mobile;
        $emp_jobs = $job->title;
        $mailData = [
            'employer' => $emp_name,
            'user' => $emp_user_name,
            'email' => $emp_user_email,
            'mobile' => $emp_user_mobile,
            'job' => $emp_jobs,
        ];
        Mail::to($employer->email)->send(new JobNotificationEmail($mailData));

        // Send Notification Mail Who job Applied
        $user_id = Auth::user()->id;
        $user = User::where('id', $user_id)->first();
        $user_name = $user->name;
        $user_job = $job->title;
        $mailData = [
            'usermail' => 'Hello ' . $user_name . ' You are applied this ' . $user_job . ' job. We will contact very soon.',
        ];
        Mail::to($user->email)->send(new JobNotificationEmail($mailData));
        Alert::success('Congrats', 'You have Applied this Job.Thank You.');

        return redirect()->route('job.myappliedjob');
    }

    // job applied
    public function myappliedjob()
    {
        $jobApplications = JobApplication::where('user_id', Auth::user()->id)->with('job.applications')->orderBy('created_at','DESC')->paginate(5);
        $job_type = JobType::where('status', 1)->get();
        return view('front.job.my_appliedjob', [
            'jobApplications' => $jobApplications,
            'job_type' => $job_type,
        ]);
    }
    // applied job remove
    public function removejobs(Request $request)
    {
        $jobApplication = JobApplication::where(['id' => $request->id, 'user_id' => Auth::user()->id])->first();

        if ($jobApplication == null) {
            Alert::info('Info', 'Job Application not Found.');
            return redirect()->back();
        }

        $jobApplication->delete(); // Delete the job application found

        Alert::success('Success', 'Job Application removed Successfully.');
        return redirect()->back();
    }

    // job saved
    public function savedjobs(Request $request) {
        $id = $request->id;
        $job = Job::find($id);

        if (!$job) {
            Alert::info('Info', 'Job not found.');
            return redirect()->back();
        }

        // Check if the user already saved the job
        $count = SavedJob::where(['user_id' => Auth::user()->id, 'job_id' => $id])->count();
        if ($count > 0) {
            Alert::info('Info', 'You already saved this job.');
            return redirect()->back();
        }

        $savedJob = new SavedJob();
        $savedJob->job_id = $id;
        $savedJob->user_id = Auth::user()->id;
        $savedJob->save();

        Alert::success('Success', 'You have successfully saved this job.');
        // return redirect()->route('job.list'); // Adjust route to your needs
        return redirect()->back();
    }

    // saved-jobs page show
    public function showSavedjobs(){
       $savedJobs = SavedJob::where(['user_id'=>Auth::user()->id])
       ->with(['job.job_type','job.applications'])
       ->orderBy('created_at','DESC')
       ->paginate(5);
        return view('front.job.savejobs',['savedJobs'=>$savedJobs]);
    }
    // remove save jobs
    public function removeSavedjobs(Request $request)
    {
        $savedjobs = SavedJob::where(['id' => $request->id, 'user_id' => Auth::user()->id])->first();
        if ($savedjobs == null) {
            Alert::info('Info', 'Job Application not Found.');
            return redirect()->back();
        }

        SavedJob::find($request->id)->delete();

        Alert::success('Success', 'Saved job removed Successfully.');
        return redirect()->back();
    }
}

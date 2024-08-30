<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Job;
use App\Models\JobType;
use App\Models\User;
// use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Alert;

class JobsController extends Controller
{
    public function index(){
        $jobs = Job::orderBy('created_at','DESC')->with('user','applications')->paginate(5);
        return view('admin.job.list',['jobs'=>$jobs]);
    }
    public function edit($id){
        $job = Job::findOrFail($id);
        $categories = Category::orderBy('name','ASC')->get();
        $jobType = JobType::orderBy('name','ASC')->get();
        return view('admin.job.edit',['job'=>$job,'categories'=>$categories,'jobType'=>$jobType]);
    }

    public function update(Request $request, $id)
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

        $job->status = $request->status;
        $job->isFeature = (!empty($request->isFeature)) ? $request->isFeature : 0;
        $job->save();
        Alert::success('Success', 'Job Updated Successfully.');
        return redirect()->route('admin.jobs-list');
    }
    public function destroy(Request $request){
        $user = Job::find($request->id);
        $user->delete();


        Alert::info('Info','Job Deleted.');
        return redirect()->route('admin.jobs-list');
    }
}

<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Alert;

class JobApplicationController extends Controller
{
    public function index(){
        $applications = JobApplication::orderBy('created_at','DESC')->with('job','user','employer')->paginate(5);

        return view('admin.job-application.list',['applications'=>$applications]);
    }
    public function destroy(Request $request){
        $user = JobApplication::find($request->id);
        $user->delete();


        Alert::info('Info','Job Application Deleted.');
        return redirect()->route('admin.jobs-applications');
    }
}

<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\JobApplicationController;
use App\Http\Controllers\admin\JobsController;
use App\Http\Controllers\admin\UsersController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// HomePage/ Main Page
Route::get('/', [HomeController::class, 'index'])->name('front.home');
// find jobs
Route::get('/find-jobs', [JobController::class, 'findjobs'])->name('job.findjobs');
// job detail
Route::get('/jobdetails/{id}', [JobController::class, 'jobdetail'])->name('job.jobdetail');
// apply jobs
Route::post('/apply-job', [JobController::class, 'applyjob'])->name('job.applyjob');
// saved jobs
Route::post('/savedjob', [JobController::class, 'savedjobs'])->name('job.saved');

// Admin Group Route
Route::group(['prefix' => 'admin', 'middleware' => 'checkRole'], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('users', [UsersController::class, 'index'])->name('admin.users');
    Route::get('users-edit/{id}',[UsersController::class,'edit'])->name('admin.useredit');
    Route::post('users-update/{id}',[UsersController::class,'update'])->name('admin.userupdate');
    // Delete User
    Route::post('/users-delete/{id}/delete', [UsersController::class, 'destroy'])->name('user.destroy');

    Route::get('jobslist', [JobsController::class, 'index'])->name('admin.jobs-list');
    Route::get('jobs-edit/{id}',[JobsController::class,'edit'])->name('admin.jobs-edit');
    Route::post('jobs-update/{id}',[JobsController::class,'update'])->name('admin.jobs-update');
    // job delete
    Route::post('/jobs-delete/{id}/delete',[JobsController::class,'destroy'])->name('admin.jobs-delete');

    // job application
    Route::get('jobsApplicationlist', [JobApplicationController::class, 'index'])->name('admin.jobs-applications');
    // job application delete
    Route::post('/jobs-delete/{id}/delete',[JobApplicationController::class,'destroy'])->name('admin.application-delete');

});

// Group Route
Route::group(['account'], function () {
    // Guset Route
    Route::group(['middleware' => 'guest'], function () {
        // Registration Page
        Route::get('/regiser', [AccountController::class, 'registration'])->name('account.registration');
        Route::post('/processReg', [AccountController::class, 'processReg'])->name('account.processReg');
        // Login Page
        Route::get('/login', [AccountController::class, 'login'])->name('account.login');
        Route::post('/authenticate', [AccountController::class, 'authenticate'])->name('account.authenticate');
    });
    // Authenticated Route
    Route::group(['middleware' => 'auth'], function () {
        // LogOut Page
        Route::get('/logout', [AccountController::class, 'logout'])->name('account.logout');
        // MY Account/Profile Page
        Route::get('/myaccount', [AccountController::class, 'myaccount'])->name('account.myaccount');
        // update account
        Route::post('/updateaccount', [AccountController::class, 'updateaccount'])->name('account.updateaccount');
        // Profile Picture
        Route::post('/update-profile-pic', [AccountController::class, 'updateProfilePic'])->name('account.pictureUpdate');
        // job create page
        Route::get('/create-job', [JobController::class, 'createJob'])->name('job.createJob');
        // job store
        Route::post('/store-job', [JobController::class, 'storeJob'])->name('job.storeJob');
        // job show/index
        Route::get('/my-jobs', [JobController::class, 'myjobs'])->name('job.myjobs');
        // edit job
        Route::get('/edit-jobs/edit/{jobId}', [JobController::class, 'editjobs'])->name('job.editjobs');
        // update job
        Route::post('/update-jobs/{jobId}', [JobController::class, 'updateJob'])->name('job.updateJob');
        // Delete job
        Route::post('/delete-jobs/{jobId}/delete', [JobController::class, 'destroy'])->name('job.destroy');
        // My applied jobs
        Route::get('/appliedjobs', [JobController::class, 'myappliedjob'])->name('job.myappliedjob');
        // Delete Applied job
        Route::post('/remove-appliedjobs/{id}/delete', [JobController::class, 'removejobs'])->name('job.removeappliedjob');
        //  Save job page show
        Route::get('/saved-jobs', [JobController::class, 'showSavedjobs'])->name('job.saved-jobs');
        // Remove Saved job
        Route::post('/remove-savedjobs/{id}/delete', [JobController::class, 'removeSavedjobs'])->name('job.removeSavedjobs');
        // update password
        Route::post('/update-password', [AccountController::class, 'updatePassword'])->name('account.updatePassword');
    });
});

<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminJobController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Recruiter\CompanyController;
use App\Http\Controllers\Recruiter\ApplicationController;
use App\Http\Controllers\Recruiter\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Recruiter\JobController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ReportController;

// Đường dẫn đăng nhập
Route::get('/auth/login', function () {return view('auth.login');})->name('login');
Route::post('/auth/login', [AuthController::class, 'login']);

// Đường dẫn đăng xuất
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Đường dẫn đăng ký người tìm việc
Route::get('/register/job-seeker', [AuthController::class, 'showJobSeekerRegistrationForm'])->name('register.job-seeker');
Route::post('/register/job-seeker', [AuthController::class, 'registerJobSeeker']);

// Đường dẫn đăng ký nhà tuyển dụng
Route::get('/register/recruiter', [AuthController::class, 'showRecruiterRegistrationForm'])->name('register.recruiter');
Route::post('/register/recruiter', [AuthController::class, 'registerRecruiter']);

// Đường dẫn đặt lại mật khẩu
Route::get('/forgot-password', function () {return view('auth.forgot-password');})->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('password.email');
Route::get('/reset-password/{token}', function ($token) {
    return view('auth.reset-password', ['token' => $token]);
})->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

// Đường dẫn công ty nhà tuyển dụng
Route::middleware('auth')->group(function () {
    Route::get('/recruiter/dashboard', [DashboardController::class, 'index'])->name('recruiter.dashboard');
    Route::get('/recruiter/company/edit', [CompanyController::class, 'edit'])->name('recruiter.company.edit');
    Route::put('/recruiter/company/update', [CompanyController::class, 'update'])->name('recruiter.company.update');

    // Đường dẫn công việc
    Route::get('/recruiter/jobs', [JobController::class, 'index'])->name('recruiter.jobs.index');
    Route::get('/recruiter/jobs/create', [JobController::class, 'create'])->name('recruiter.jobs.create');
    Route::post('/recruiter/jobs', [JobController::class, 'store'])->name('recruiter.jobs.store');
    Route::get('/recruiter/jobs/{job}/edit', [JobController::class, 'edit'])->name('recruiter.jobs.edit');
    Route::put('/recruiter/jobs/{job}', [JobController::class, 'update'])->name('recruiter.jobs.update');
    Route::delete('/recruiter/jobs/{job}', [JobController::class, 'destroy'])->name('recruiter.jobs.destroy');

    // Đường dẫn ứng dụng
    Route::get('/recruiter/applications', [ApplicationController::class, 'index'])->name('recruiter.applications.index');
    Route::get('/recruiter/applications/{application}', [ApplicationController::class, 'show'])->name('recruiter.applications.show');
    Route::put('/recruiter/applications/{application}/status', [ApplicationController::class, 'updateStatus'])->name('recruiter.applications.update-status');
    Route::get('/recruiter/applications/{application}/download-cv', [ApplicationController::class, 'downloadCV'])->name('recruiter.applications.download-cv');
    Route::delete('/recruiter/applications/{application}', [ApplicationController::class, 'destroy'])->name('recruiter.applications.destroy');
});



// Đường dẫn quản trị viên
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class)->except(['show']);
    Route::put('users/{id}/banned', [UserController::class, 'banned'])->name('users.banned');
    Route::put('users/{id}/unbanned', [UserController::class, 'unbanned'])->name('users.unbanned');

    // Đường dẫn lọc người dùng
    Route::get('users/recruiters', [UserController::class, 'recruiters'])->name('users.recruiters');
    Route::get('users/job_seekers', [UserController::class, 'job_seekers'])->name('users.job_seekers');
    Route::get('users/banned', [UserController::class, 'banned'])->name('users.banned');

    // Đường dẫn quản lý công việc
    Route::get('/jobs', [AdminJobController::class, 'index'])->name('jobs.index');
    Route::get('/jobs/pending', [AdminJobController::class, 'pending'])->name('jobs.pending');
    Route::get('/jobs/approved', [AdminJobController::class, 'approved'])->name('jobs.approved');
    Route::post('/jobs/{id}/approve', [AdminJobController::class, 'approve'])->name('jobs.approve');
    Route::post('/jobs/{id}/reject', [AdminJobController::class, 'reject'])->name('jobs.reject');
    Route::delete('/jobs/{id}', [AdminJobController::class, 'destroy'])->name('jobs.destroy');
    Route::post('/jobs/{job}/toggle-featured', [AdminJobController::class, 'toggleFeatured'])->name('jobs.toggle-featured');

    // Đường dẫn quản lý danh mục
    Route::resource('categories', CategoryController::class);

    // Đường dẫn quản lý báo cáo
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/{report}', [ReportController::class, 'show'])->name('reports.show');
});



// Đường dẫn người tìm việc
use App\Http\Controllers\JobSeeker\HomeController;
use App\Http\Controllers\JobSeeker\JobSeekerController;
use App\Http\Controllers\JobSeeker\ProfileController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/job-seeker/home', [HomeController::class, 'index'])->name('home');
Route::post('/jobs/{id}/apply', [JobSeekerController::class, 'applyJob'])->name('job.apply');
Route::get('jobs/{job}', [JobSeekerController::class, 'show'])->name('detail-job');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('job-seeker.profile.update');
});

Route::get('/companies', [CompanyController::class, 'index'])->name('companies.index');
Route::get('/about', function () {
    return view('general.seekajob-company');
})->name('about');
Route::get('/contact', function () {
    return view('general.contact');
})->name('contact');
Route::get('/help', function () {
    return view('general.help');
})->name('help');
Route::get('/top-companies', [CompanyController::class, 'topCompanies'])->name('companies.top');
Route::post('/save-job', [JobSeekerController::class, 'toggleSaveJob'])->name('save-job');
Route::get('/saved-jobs', [JobSeekerController::class, 'showSavedJobs'])->name('saved-jobs');
Route::get('/latest-jobs', [JobSeekerController::class, 'showLatestJobs'])->name('latest-jobs');
Route::get('/terms-of-service', [HomeController::class, 'termsOfService'])->name('terms-of-service');
Route::get('/privacy-policy', [HomeController::class, 'privacyPolicy'])->name('privacy-policy');

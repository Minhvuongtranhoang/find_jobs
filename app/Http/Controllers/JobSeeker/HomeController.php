<?php

namespace App\Http\Controllers\JobSeeker;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Category;
use App\Models\Company;
use Illuminate\Routing\Controller;


class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $featuredJobs = Job::where('is_featured', 1)->get();
        $highlightedCategories = Category::whereIn('id', [/* List IDs of featured categories */])->get();
        $featuredCompanies = Company::where('is_featured', 1)->take(5)->get();
        $jobs = Job::latest()->take(6)->get();
     

        return view('job-seeker.home', compact('categories', 'featuredJobs', 'highlightedCategories', 'featuredCompanies', 'jobs'));
    }
    // Hiển thị trang Điều khoản sử dụng
    public function termsOfService()
    {
        return view('general.terms-of-service');
    }

    // Hiển thị trang Chính sách bảo mật
    public function privacyPolicy()
    {
        return view('general.privacy-policy');
    }
}

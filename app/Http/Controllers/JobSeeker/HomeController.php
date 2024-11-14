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
        $featuredCompanies = Company::take(5)->get();
        $jobs = Job::latest()->take(6)->get();
        // $blogs = Blog::latest()->take(3)->get();

        return view('job-seeker.home', compact('categories', 'featuredJobs', 'highlightedCategories', 'featuredCompanies', 'jobs'));// nhớ thêm blogg vào
    }
}

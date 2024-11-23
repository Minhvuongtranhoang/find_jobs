<?php

namespace App\Http\Controllers\JobSeeker;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Category;
use App\Models\Company;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\File;

class HomeController extends Controller
{
    public function index(Request $request)
{
    // Lấy danh sách các categories
    $categories = Category::all();

    // Lấy các công việc nổi bật
    $featuredJobs = Job::where('is_featured', 1)->get();

    // Lấy các categories được đánh dấu nổi bật
    $highlightedCategories = Category::whereIn('id', [/* List IDs of featured categories */])->get();

    // Lấy các công ty nổi bật
    $featuredCompanies = Company::where('is_featured', 1)->take(6)->get();

    // Lấy các công việc gần đây
    $jobs = Job::latest()->take(6)->get();

    // Đọc danh sách địa phương từ file JSON
    $locations = json_decode(File::get(resource_path('provinces.json')), true);

    // Tìm kiếm theo từ khóa (nếu có)
    $keyword = $request->input('keyword');

    // Khởi tạo query để tìm công việc
    // $query = Job::query();

    // Truyền tất cả dữ liệu vào view
    return view('job-seeker.home', compact('categories', 'featuredJobs', 'highlightedCategories', 'featuredCompanies', 'jobs', 'locations'));
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

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
    $categories = Category::all();

    // Lấy các danh mục nổi bật
    $highlightedCategories = Category::where('is_featured', true)
        ->withCount('jobs')
        ->take(4)
        ->get();

    // Lấy các công việc nổi bật
    $featuredJobs = Job::where('is_featured', 1)
        ->latest()
        ->take(6)
        ->get();

    // Lấy các công ty nổi bật
    $featuredCompanies = Company::where('is_featured', 1)->take(6)->get();

    // Lấy các công việc gần đây
    $jobs = Job::latest()->take(6)->get();


    // Đọc danh sách địa phương từ file JSON
    $locations = json_decode(File::get(resource_path('provinces.json')), true);

    // Lấy từ khóa tìm kiếm (nếu có)
    $keyword = $request->input('keyword');

    // Lấy các công việc gần đây, phân trang
    $jobs = Job::when($keyword, function ($query, $keyword) {
            $query->where('title', 'LIKE', '%' . $keyword . '%');
        })
        ->latest()
        ->paginate(6);

    // Kiểm tra nếu là yêu cầu AJAX
    if ($request->ajax()) {
        return response()->json([
            'jobs' => view('job-seeker.jobs', compact('jobs'))->render(),
            'pagination' => view('job-seeker.pagination', compact('jobs'))->render()
        ]);
    }

    // Truyền dữ liệu vào view
    return view('job-seeker.home', compact(
        'categories',
        'highlightedCategories',
        'featuredJobs',
        'featuredCompanies',
        'jobs',
        'locations'
    ));
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
    public function showJobs($id)
    {
        $category = Category::findOrFail($id);
        $jobs = $category->jobs()->with('company', 'location')->get();

        return view('job-seeker.category-jobs', compact('category', 'jobs'));
    }


}

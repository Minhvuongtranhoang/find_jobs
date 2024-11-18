<?php

namespace App\Http\Controllers\JobSeeker;

use Illuminate\Routing\Controller;

use App\Models\Job;
use App\Models\SavedJob;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\CompanyLocation;
use Illuminate\Support\Facades\File;

class JobSeekerController extends Controller
{
    public function searchJobs(Request $request)
{
    // Lấy danh sách các categories
    $categories = Category::all();

    // Đọc danh sách địa phương từ file JSON
    $locations = json_decode(File::get(resource_path('provinces.json')), true);

    // Lấy từ khóa tìm kiếm
    $keyword = $request->input('keyword');

    // Lấy category_id
    $category_id = $request->input('category_id');

    // Lấy city
    $city = $request->input('location');

    // Khởi tạo query
    $query = Job::query();

    // Tìm kiếm theo từ khóa
    if ($keyword) {
        $query->where(function ($q) use ($keyword) {
            $q->where('title', 'like', '%' . $keyword . '%')
              ->orWhere('description', 'like', '%' . $keyword . '%');
        });
    }

    // Tìm kiếm theo category_id qua bảng job_categories
    if ($category_id) {
        $query->whereHas('categories', function ($q) use ($category_id) {
            $q->where('id', $category_id);
        });
    }

    // Tìm kiếm theo city (liên kết qua công ty và company_locations)
    if ($city) {
        $query->whereHas('company.locations', function ($q) use ($city) {
            $q->where('city', $city);
        });
    }

    // Lấy danh sách công việc
    $jobs = $query->get();

    // Truyền dữ liệu vào view
    return view('job-seeker.search-results', compact('categories', 'jobs', 'locations', 'keyword', 'category_id', 'city'));
}




    public function show(Job $job)
    {
        return view('job-seeker.detail-job', compact('job'));
    }

    public function toggleSaveJob(Request $request)
    {
        if (!auth()->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $userId = auth()->id();
        $jobId = $request->job_id;

        // Kiểm tra xem công việc đã được lưu chưa
        $savedJob = SavedJob::where('user_id', $userId)->where('job_id', $jobId)->first();

        if ($savedJob) {
            // Nếu đã lưu thì xóa
            $savedJob->delete();
            return response()->json(['status' => 'removed']);
        } else {
            // Nếu chưa lưu thì thêm mới
            SavedJob::create([
                'user_id' => $userId,
                'job_id' => $jobId,
            ]);
            return response()->json(['status' => 'saved']);
        }
    }
    public function showSavedJobs()
    {
        $userId = auth()->id();

        // Lấy tất cả công việc đã lưu của người dùng
        $savedJobs = SavedJob::where('user_id', $userId)->with('job.company', 'job.location')->get();

        return view('job-seeker.saved-jobs', compact('savedJobs'));
    }
    public function showLatestJobs()
    {
        // Lấy các công việc mới nhất theo id giảm dần
        $jobs = Job::with('company', 'location') // Bao gồm thông tin công ty và vị trí
            ->orderBy('id', 'desc') // Sắp xếp theo id từ lớn nhất đến nhỏ nhất
            ->paginate(9); // Sử dụng phân trang, 10 công việc mỗi trang

        return view('job-seeker.latest-jobs', compact('jobs'));
    }

    public function apply(Request $request, Job $job)
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để ứng tuyển.');
        }

        // Validate the form input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'cv_file' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'cover_letter' => 'nullable|string|max:1000',
        ]);

        // Kiểm tra xem người dùng đã ứng tuyển công việc này chưa
        $existingApplication = JobApplication::where('job_id', $job->id)
            ->where('user_id', auth()->id()) // Assumes user is logged in
            ->first();

        if ($existingApplication) {
            return redirect()->back()->with('error', 'Bạn đã ứng tuyển công việc này trước đó.');
        }

        // Store the uploaded CV file
        $cvFilePath = $request->file('cv_file')->store('cvs', 'public');

        // Save job application to the database
        JobApplication::create([
            'job_id' => $job->id,
            'user_id' => auth()->id(), // Assumes user is logged in
            'cv_file' => $cvFilePath,
            'cover_letter' => $request->input('cover_letter'),
        ]);

        // Redirect back with success message
        return redirect()->back()->with('success', 'Ứng tuyển thành công! Chúng tôi sẽ sớm liên hệ với bạn.');
    }



    public function getMyApplications()
    { {
            // Lấy danh sách các ứng dụng công việc của người dùng hiện tại
            $applications = JobApplication::with('job')
                ->where('user_id', auth()->id())
                ->latest()
                ->get();

            return view('job-seeker.job-applications', compact('applications'));
        }
    }

    public function getSavedJobs()
    {
        $savedJobs = SavedJob::with(['job.company', 'job.location'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $savedJobs
        ]);
    }
}

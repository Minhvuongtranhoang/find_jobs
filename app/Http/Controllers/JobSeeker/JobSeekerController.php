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
use App\Models\Company;
use App\Models\Report;
use App\Models\Notification;

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
                $q->where('title', 'like', '%' . $keyword . '%')->orWhere('description', 'like', '%' . $keyword . '%');
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
        // Nạp các mối quan hệ 'company', 'location', và 'categories'
        $job = Job::with(['company', 'location', 'categories'])->findOrFail($job->id);

        // Lấy các công việc liên quan cùng danh mục (loại trừ công việc hiện tại)
        $relatedJobs = Job::whereHas('categories', function ($query) use ($job) {
            $query->whereIn('id', $job->categories->pluck('id'));
        })
            ->where('id', '!=', $job->id) // Loại trừ công việc hiện tại
            ->get();

        return view('job-seeker.detail-job', compact('job', 'relatedJobs'));
    }

    public function toggleSaveJob(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $userId = Auth::id();
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
        $userId = Auth::id();

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
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Validate the form input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'cv_file' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'cover_letter' => 'nullable|string|max:1000',
        ]);

        // Store the uploaded CV file
        $cvFilePath = $request->file('cv_file')->store('cvs', 'public');
        $jobId = $request->job_id;
        // Kiểm tra xem người dùng đã ứng tuyển công việc này chưa
        $existingApplication = JobApplication::where('job_id', $jobId)
            ->where('user_id', Auth::id()) // Assumes user is logged in
            ->first();
        if ($existingApplication) {
            return response()->json(['status' => 'already_applied']);
        }

        // Save job application to the database
        JobApplication::create([
            'job_id' => $jobId,
            'user_id' => Auth::id(), // Assumes user is logged in
            'cv_file' => $cvFilePath,
            'cover_letter' => $request->input('cover_letter'),
        ]);

        // Redirect back with success message
        return response()->json(['status' => 'applied']);
    }

    public function getMyApplications()
    {
        // Lấy danh sách các ứng dụng công việc của người dùng hiện tại
        $applications = JobApplication::with('job')->where('user_id', Auth::id())->latest()->get();

        return view('job-seeker.job-applications', compact('applications'));
    }

    public function getSavedJobs()
    {
        $savedJobs = SavedJob::with(['job.company', 'job.location'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $savedJobs,
        ]);
    }
    public function showCompany($id)
    {
        $company = Company::with(['locations', 'jobs'])->findOrFail($id);
        return view('job-seeker.company-show', compact('company'));
    }

    public function reportJob(Request $request, $jobId)
    {
        $request->validate([
            'reason' => 'required|string|max:1000',
        ]);

        Report::create([
            'reporter_id' => auth()->id(),
            'reported_type' => 'job',
            'reported_id' => $jobId,
            'reason' => $request->input('reason'),
            'status' => 'pending',
        ]);

        return response()->json(['status' => 'reported']);
    }

    public function getNotifications(Request $request)
    {
        $notifications = Notification::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($notifications);
    }

    // Đánh dấu thông báo đã đọc
    public function markAsRead($id)
    {
        $notification = Notification::where('id', $id)
            ->where('user_id', auth()->id())
            ->first();

        if ($notification) {
            $notification->update(['is_read' => true]);
            return response()->json(['status' => 'success']);
        }

        return response()->json(['status' => 'error'], 404);
    }

    // Xóa thông báo
    public function deleteNotification($id)
    {
        $notification = Notification::where('id', $id)
            ->where('user_id', auth()->id())
            ->first();

        if ($notification) {
            $notification->delete();
            return response()->json(['status' => 'success']);
        }

        return response()->json(['status' => 'error'], 404);
    }
}

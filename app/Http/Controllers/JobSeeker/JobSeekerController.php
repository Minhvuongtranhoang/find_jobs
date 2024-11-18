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

class JobSeekerController extends Controller
{
    public function searchJobs(Request $request)
    {
        // Khởi tạo query tìm kiếm
        $query = Job::with(['company', 'location', 'categories'])->where('status', 'approved');

        // Kiểm tra nếu có keyword
        if ($request->has('keyword') && $request->keyword) {
            $query->where('title', 'like', '%' . $request->keyword . '%');
        }

        // Kiểm tra nếu có category_id
        if ($request->has('category_id') && $request->category_id) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('id', $request->category_id);
            });
        }

        // Kiểm tra nếu có location
        if ($request->has('location') && $request->location) {
            $query->whereHas('location', function ($q) use ($request) {
                $q->where('city', 'like', '%' . $request->location . '%');
            });
        }

        // Lấy kết quả và phân trang
        $jobs = $query->paginate(10);

        // Trả kết quả về view
        return view('job-seeker.search-results', compact('jobs'));
    }



    public function show(Job $job)
    {
        return view('job-seeker.detail-job', compact('job'));
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
            ->paginate(10); // Sử dụng phân trang, 10 công việc mỗi trang

        return view('job-seeker.latest-jobs', compact('jobs'));
    }

    public function apply(Request $request, Job $job)
    {
        // Validate the form input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'cv_file' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'cover_letter' => 'nullable|string|max:1000',
        ]);

        // Store the uploaded CV file
        $cvFilePath = $request->file('cv_file')->store('cv_files', 'public');

        // Save job application to the database
        JobApplication::create([
            'job_id' => $job->id,
            'user_id' => Auth::id(), // Assumes user is logged in
            'cv_file' => $cvFilePath,
            'cover_letter' => $request->input('cover_letter'),
        ]);

        // Redirect back with success message
        return redirect()->back()->with('success', 'Ứng tuyển thành công! Chúng tôi sẽ sớm liên hệ với bạn.');
    }

    public function getMyApplications()
    {
        {
                    // Lấy danh sách các ứng dụng công việc của người dùng hiện tại
            $applications = JobApplication::with('job')
                ->where('user_id', Auth::id())
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

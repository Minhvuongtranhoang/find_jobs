<?php

namespace App\Http\Controllers\JobSeeker;

use Illuminate\Routing\Controller;

use App\Models\Job;
use App\Models\SavedJob;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class JobSeekerController extends Controller
{
    public function searchJobs(Request $request)
    {
        $query = Job::with(['company', 'location', 'categories'])
            ->where('status', 'approved');

        if ($request->has('keyword')) {
            $query->where('title', 'like', '%' . $request->keyword . '%');
        }

        if ($request->has('category')) {
            $query->whereHas('categories', function($q) use ($request) {
                $q->where('id', $request->category);
            });
        }

        if ($request->has('location')) {
            $query->whereHas('location', function($q) use ($request) {
                $q->where('address', 'like', '%' . $request->location . '%');
            });
        }

        $jobs = $query->paginate(10);

        return response()->json([
            'status' => 'success',
            'data' => $jobs
        ]);
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
            ->paginate(10); // Sử dụng phân trang, 10 công việc mỗi trang

        return view('job-seeker.latest-jobs', compact('jobs'));
    }

    public function applyJob(Request $request, $jobId)
    {
        $validated = $request->validate([
            'cv_file' => 'required|file|mimes:doc,docx,pdf|max:2048',
            'full_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'cover_letter' => 'required|string'
        ]);

        $cvPath = $request->file('cv_file')->store('cvs', 'public');

        $application = JobApplication::create([
            'job_id' => $jobId,
            'user_id' => Auth::id(),
            'cv_file' => $cvPath,
            'cover_letter' => $validated['cover_letter'],
            'status' => 'pending'
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Application submitted successfully',
            'data' => $application
        ]);
    }

    public function getMyApplications()
    {
        $applications = JobApplication::with(['job.company'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $applications
        ]);
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

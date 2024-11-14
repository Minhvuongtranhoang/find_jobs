<?php

namespace App\Http\Controllers\JobSeeker;

use Illuminate\Routing\Controller;
use App\Models\Job;
use App\Models\SavedJob;
use App\Models\JobApplication;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function search(Request $request)
    {
        $query = Job::query();

        if ($request->keyword) {
            $query->where('title', 'like', "%{$request->keyword}%");
        }

        if ($request->category) {
            $query->whereHas('categories', function($q) use ($request) {
                $q->where('category_id', $request->category);
            });
        }

        if ($request->location) {
            $query->whereHas('location', function($q) use ($request) {
                $q->where('address', 'like', "%{$request->location}%");
            });
        }

        return view('search', [
            'jobs' => $query->paginate(10)
        ]);
    }

    public function show(Job $job)
    {
        return view('detail-job', compact('job'));
    }

    public function toggleSave(Job $job)
    {
        $savedJob = SavedJob::where([
            'job_id' => $job->id,
            'seeker_id' => auth()->guard()->user()->jobSeeker->seeker_id
        ])->first();

        if ($savedJob) {
            $savedJob->delete();
        } else {
            SavedJob::create([
                'job_id' => $job->id,
                'seeker_id' => auth()->guard()->user()->jobSeeker->seeker_id
            ]);
        }

        return back();
    }

    public function apply(Request $request, Job $job)
    {
        $request->validate([
            'cv_file' => 'required|mimes:doc,docx,pdf|max:2048',
            'cover_letter' => 'required'
        ]);

        $cvPath = $request->file('cv_file')->store('cvs', 'public');

        JobApplication::create([
            'job_id' => $job->id,
            'seeker_id' => auth()->guard()->user()->jobSeeker->seeker_id,
            'cv_file' => $cvPath,
            'cover_letter' => $request->cover_letter
        ]);

        return redirect()->route('my.applications')->with('success', 'Application submitted successfully');
    }
}

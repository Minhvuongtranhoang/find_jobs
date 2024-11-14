<?php

namespace App\Http\Controllers\Recruiter;

use Illuminate\Routing\Controller;
use App\Models\JobApplication;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ApplicationController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $user = Auth::user();
        if(!$user || !$user->recruiter) {
            return redirect()->route('login')->withErrors("you must be logged in to view this page");
        }
        $applications = JobApplication::whereHas('job', function ($query) {
                return $query->where('company_id', Auth::user()->recruiter->company_id);
            })
            ->with(['user.jobSeeker', 'job'])
            ->latest()
            ->paginate(15);

        return view('recruiter.applications.index', compact('applications'));
    }

    public function show(JobApplication $application)
    {
        $this->authorize('view', $application);
        return view('recruiter.applications.show', compact('application'));
    }

    public function updateStatus(Request $request, JobApplication $application)
    {
        $this->authorize('update', $application);

        $request->validate([
            'status' => 'required|in:approved,rejected',
            'note' => 'nullable|string|max:500'
        ]);

        $application->update(['status' => $request->status]);

        // Create status history
        $application->statusHistory()->create([
            'status' => $request->status,
            'note' => $request->note
        ]);

        // Create notification for job seeker
        $title = $request->status === 'approved'
            ? 'Application Approved'
            : 'Application Rejected';

        $content = $request->status === 'approved'
            ? "Your application for {$application->job->title} has been approved!"
            : "Your application for {$application->job->title} has been rejected.";

        Notification::create([
            'user_id' => $application->user_id,
            'title' => $title,
            'content' => $content
        ]);

        return redirect()->route('recruiter.applications.index')
            ->with('success', 'Application status updated successfully.');
    }

    public function downloadCV(JobApplication $application)
    {
      $this->authorize('view', $application);

      if (Storage::disk('public')->exists($application->cv_file)) {
          return response()->download(storage_path('app/public/' . $application->cv_file));
      }

      return redirect()->back()->withErrors('CV file not found.');
  }

    public function store(Request $request)
    {
        $request->validate([
            'cv_file' => 'required|file|mimes:pdf,doc,docx|max:2048',
            // other validation rules
        ]);

        $cvFilePath = $request->file('cv_file')->store('cvs','public');

        JobApplication::create([
            'job_id' => $request->job_id,
            'user_id' => Auth::id(),
            'cv_file' => $cvFilePath,
            // other fields
        ]);

        return redirect()->route('recruiter.applications.index')->with('success', 'Application submitted successfully.');
    }

    public function destroy(JobApplication $application)
    {
        $this->authorize('delete', $application);

        $application->delete();

        return redirect()->route('recruiter.applications.index')->with('success', 'Application deleted successfully.');
    }
}

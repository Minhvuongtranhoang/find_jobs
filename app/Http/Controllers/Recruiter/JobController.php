<?php

namespace App\Http\Controllers\Recruiter;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;
use App\Models\Job;
use App\Http\Requests\JobCreateRequest;
use App\Http\Requests\JobUpdateRequest;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    use AuthorizesRequests;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }
        $jobs = Auth::user()->recruiter->company->jobs()
            ->with('location')
            ->latest()
            ->paginate(10);

        return view('recruiter.jobs.index', compact('jobs'));
    }

    public function create()
{
    $company = Auth::user()->recruiter->company;
    $locations = $company->locations;
    return view('recruiter.jobs.create', compact('locations'));
}

public function store(JobCreateRequest $request)
{
    $company = Auth::user()->recruiter->company;
    $job = $company->jobs()->create($request->validated());

    if ($request->has('categories')) {
        $job->categories()->sync($request->categories);
    }

    return redirect()->route('recruiter.jobs.index')
        ->with('success', 'Job posted successfully and pending approval.');
}

public function edit(Job $job)
{
    $job->load('company.recruiters.user');

    if (!$job) {
        return redirect()->route('recruiter.jobs.index')
            ->with('error', 'Job not found.');
    }

    $this->authorize('update', $job);
    $locations = $job->company->locations;
    return view('recruiter.jobs.edit', compact('job', 'locations'));
}

public function update(JobUpdateRequest $request, Job $job)
{
    $job->load('company.recruiters.user');

    if (!$job) {
        return redirect()->route('recruiter.jobs.index')
            ->with('error', 'Job not found.');
    }

    $this->authorize('update', $job);
    $job->update($request->validated());

    if ($request->has('categories')) {
        $job->categories()->sync($request->categories);
    }

    return redirect()->route('recruiter.jobs.index')
        ->with('success', 'Job updated successfully.');
}

    public function destroy(Job $job)
    {
        $job->load('company.recruiters.user'); // Eager load the necessary relationships

        if (!$job) {
            return redirect()->route('recruiter.jobs.index')
                ->with('error', 'Job not found.');
        }

        $this->authorize('delete', $job);
        $job->delete();

        return redirect()->route('recruiter.jobs.index')
            ->with('success', 'Job deleted successfully.');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AdminJobController extends Controller
{
    public function index()
    {
        $jobs = Job::all();
        return view('admin.jobs.index', compact('jobs'));
    }

    public function pending()
    {
        $jobs = Job::where('status', 'pending')->get();
        return view('admin.jobs.pending', compact('jobs'));
    }

    public function approved()
    {
        $jobs = Job::where('status', 'approved')->get();
        return view('admin.jobs.approved', compact('jobs'));
    }

    public function approve($id)
    {
        $job = Job::findOrFail($id);
        $job->status = 'approved';
        $job->save();

        return redirect()->route('admin.jobs.pending')->with('success', 'Job approved successfully.');
    }

    public function reject($id)
    {
        $job = Job::findOrFail($id);
        $job->status = 'rejected';
        $job->save();

        return redirect()->route('admin.jobs.pending')->with('success', 'Job rejected successfully.');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'location_id' => 'required|exists:company_locations,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'requirements' => 'required|string',
            'benefits' => 'nullable|string',
            'working_hours' => 'nullable|string',
            'salary' => 'nullable|numeric',
            'deadline' => 'required|date',
            'status' => 'required|string|in:pending,approved,rejected',
            'is_featured' => 'boolean',
            'category_id' => 'required|exists:categories,id',
        ]);

        Job::create($validatedData);

        return redirect()->route('admin.jobs.index')->with('success', 'Job created successfully.');

    }

    public function destroy($id)
    {
        $job = Job::findOrFail($id);
        $job->delete();

        return redirect()->route('admin.jobs.index')->with('success', 'Job deleted successfully.');
    }

    public function toggleFeatured(Job $job)
    {
        $job->is_featured = !$job->is_featured;
        $job->save();

        return redirect()->route('admin.jobs.index')->with('success', 'Job feature status updated successfully.');
    }
}

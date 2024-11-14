<?php

namespace App\Http\Controllers\JobSeeker;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show()
    {
        $jobSeeker = auth()->guard()->user()->jobSeeker;
        return view('jobseeker.profile.show', compact('jobSeeker'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'full_name' => 'required',
            'avatar' => 'nullable|image|max:1024'
        ]);

        $jobSeeker = auth()->guard()->user()->jobSeeker;
        $jobSeeker->update($request->only('full_name'));

        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $jobSeeker->update(['avatar' => $avatarPath]);
        }

        return back()->with('success', 'Profile updated successfully');
    }
}

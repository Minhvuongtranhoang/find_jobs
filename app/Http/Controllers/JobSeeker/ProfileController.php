<?php

namespace App\Http\Controllers\JobSeeker;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show()
    {
        $jobSeeker = auth()->guard()->user()->jobSeeker;
        return view('job-seeker.profile', compact('jobSeeker'));
    }

    public function update(Request $request)
{
    $request->validate([
        'full_name' => 'required',
        'avatar' => 'nullable|image|max:2048'
    ]);

    $jobSeeker = auth()->guard()->user()->jobSeeker;

    // Cập nhật tên
    $jobSeeker->update($request->only('full_name'));

    if ($request->hasFile('avatar')) {
        // Xóa tệp cũ nếu tồn tại
        if ($jobSeeker->avatar && file_exists(public_path($jobSeeker->avatar))) {
            unlink(public_path($jobSeeker->avatar));
        }

        // Lấy file và tạo tên tệp
        $avatarFile = $request->file('avatar');
        $avatarName = time() . '_' . $avatarFile->getClientOriginalName();

        // Lưu file vào thư mục public/storage/avatars
        $avatarFile->move(public_path('storage/avatars'), $avatarName);

        // Lưu đường dẫn tệp vào database
        $jobSeeker->update(['avatar' => 'storage/avatars/' . $avatarName]);
    }

    return back()->with('success', 'Profile updated successfully');
}

}

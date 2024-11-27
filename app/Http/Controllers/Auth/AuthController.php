<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Routing\Controller;
use App\Models\User;
use App\Models\Company;
use App\Models\CompanyLocation;
use App\Models\JobSeeker;
use App\Models\Recruiter;
use App\Models\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    /**
     * Show job seeker registration form
     */
    public function showJobSeekerRegistrationForm()
    {
        return view('auth.register.job-seeker');
    }

    /**
     * Show recruiter registration form
     */
    public function showRecruiterRegistrationForm()
    {
        return view('auth.register.recruiter');
    }

    /**
     * Handle user login
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirect based on user role
            $user = Auth::user();
            if ($user->role === 'job_seeker') {
                return redirect()->intended('/job-seeker/home');
            } elseif ($user->role === 'recruiter') {
                return redirect()->intended('/recruiter/dashboard');
            } elseif ($user->role === 'admin') {
                return redirect()->intended('/admin/dashboard');
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->except('password'));
    }

    /**
     * Handle job seeker registration
     */
    public function registerJobSeeker(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:users',
            'password' => ['required', 'confirmed', Password::defaults()],
            'phone' => 'required|string|max:20',
            'full_name' => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            $user = User::create([
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'phone' => $validated['phone'],
                'role' => 'job_seeker',
            ]);

            JobSeeker::create([
                'user_id' => $user->id,
                'full_name' => $validated['full_name'],
            ]);

            DB::commit();
            Auth::login($user);

            return redirect('/auth/login')
                ->with('success', 'Registration successful!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Registration failed. Please try again.'])
                        ->withInput($request->except('password'));
        }
    }

    /**
     * Handle recruiter registration
     */
    public function registerRecruiter(Request $request)
{
    $validated = $request->validate([
        'email' => 'required|email|unique:users',
        'password' => ['required', 'confirmed', Password::defaults()],
        'phone' => 'required|string|max:20',
        'company_name' => 'required|string|max:255',
        'house_number' => 'required|string|max:50',
        'street' => 'required|string|max:255',
        'ward' => 'required|string|max:100',
        'district' => 'required|string|max:100',
        'city' => 'required|string|max:100',
        'google_maps_link' => 'nullable|url',
    ]);

    DB::beginTransaction();
    try {
        // Tạo user mới
        $user = User::create([
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'phone' => $validated['phone'],
            'role' => 'recruiter',
        ]);

        // Tạo công ty mới
        $company = Company::create([
            'name' => $validated['company_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
        ]);

        // Lưu thông tin địa chỉ công ty vào bảng company_locations
        CompanyLocation::create([
            'company_id' => $company->id,
            'house_number' => $validated['house_number'],
            'street' => $validated['street'],
            'ward' => $validated['ward'],
            'district' => $validated['district'],
            'city' => $validated['city'],
            'google_maps_link' => $validated['google_maps_link'],
        ]);

        // Tạo đối tượng recruiter liên kết với user và company
        Recruiter::create([
            'user_id' => $user->id,
            'company_id' => $company->id,
        ]);

        DB::commit();
        Auth::login($user);

        return redirect('/auth/login')
            ->with('success', 'Đăng ký thành công!');
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->withErrors(['error' => 'Đăng ký thất bại. Vui lòng thử lại.'])
                    ->withInput($request->except('password'));
    }
}


    /**
     * Handle user logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    /**
     * Handle forgot password request
     */
    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $token = Str::random(64);
        $user = User::where('email', $request->email)->first();

        PasswordReset::create([
            'user_id' => $user->id,
            'token' => $token,
            'expires_at' => now()->addHours(24),
        ]);

        // Send password reset email
        Mail::send('emails.forgot-password', ['token' => $token], function($message) use($request) {
            $message->to($request->email);
            $message->subject('Reset Password Notification');
        });

        return back()->with('status', 'Password reset link sent to your email!');
    }

    /**
     * Handle password reset
     */
    public function resetPassword(Request $request)
    {
        $request->validate(rules: [
            'token' => 'required',
            'email' => 'required|email|exists:users',
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $passwordReset = PasswordReset::where('token', $request->token)
            ->where('expires_at', '>', now())
            ->first();

        if (!$passwordReset) {
            return back()->withErrors(['error' => 'Invalid or expired password reset token.']);
        }

        $user = User::find($passwordReset->user_id);
        $user->password = Hash::make($request->password);
        $user->save();

        PasswordReset::where('user_id', $user->id)->delete();

        return redirect()->route('login')
            ->with('status', 'Password has been reset successfully!');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string',
        ]);

        User::create($request->all());

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'role' => 'required|string',
        ]);

        $user = User::findOrFail($id);
        $user->update($request->all());

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }

    public function banned(Request $request, $id)
{
    $request->validate([
        'note' => 'required|string|max:255',
    ]);

    $user = User::findOrFail($id);
    $user->is_banned = true;
    $user->banned_at = now();
    $user->banned_reason = $request->note;
    $user->save();

    return redirect()->route('admin.users.index')->with('success', 'User banned successfully.');
}

public function unbanned($id)
{
    $user = User::findOrFail($id);
    $user->is_banned = false;
    $user->banned_at = null;
    $user->banned_reason = null;
    $user->save();

    return redirect()->route('admin.users.index')->with('success', 'User unbanned successfully.');
}

    public function recruiters()
    {
        $users = User::where('role', 'recruiter')->get();
        return view('admin.users.index', compact('users'));
    }

    public function job_seekers()
    {
        $users = User::where('role', 'job_seeker')->get();
        return view('admin.users.index', compact('users'));
    }

    // public function banned()
    // {
    //     $users = User::where('is_banned', true)->get();
    //     return view('admin.users.index', compact('users'));
    // }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.show', compact('user'));
    }
}

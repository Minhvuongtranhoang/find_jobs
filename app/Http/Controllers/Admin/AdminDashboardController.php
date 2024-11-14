<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }
}

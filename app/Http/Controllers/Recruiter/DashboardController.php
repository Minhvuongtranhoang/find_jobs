<?php

namespace App\Http\Controllers\Recruiter;

use Illuminate\Routing\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('recruiter/dashboard');
    }
}

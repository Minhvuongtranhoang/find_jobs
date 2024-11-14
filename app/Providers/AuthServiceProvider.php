<?php
// app/Providers/AuthServiceProvider.php

namespace App\Providers;

use App\Models\JobApplication;
use App\Policies\JobApplicationPolicy;
use App\Models\Job;
use App\Policies\JobPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        JobApplication::class => JobApplicationPolicy::class,
        Job::class => JobPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}

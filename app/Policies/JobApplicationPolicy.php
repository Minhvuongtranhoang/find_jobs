<?php
// app/Policies/JobApplicationPolicy.php

namespace App\Policies;

use App\Models\User;
use App\Models\JobApplication;
use Illuminate\Auth\Access\HandlesAuthorization;

class JobApplicationPolicy
{
    use HandlesAuthorization;

    public function view(User $user, JobApplication $application)
    {
        return $user->id === $application->user_id || $user->recruiter->company_id === $application->job->company_id;
    }

    public function update(User $user, JobApplication $application)
    {
        return $user->recruiter->company_id === $application->job->company_id;
    }
}

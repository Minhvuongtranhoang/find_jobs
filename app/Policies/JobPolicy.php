<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Job;
use Illuminate\Auth\Access\HandlesAuthorization;

class JobPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Job $job)
    {
        return $job->company && $job->company->recruiters->contains('user_id', $user->id);
    }

    public function delete(User $user, Job $job)
    {
        return $job->company && $job->company->recruiters->contains('user_id', $user->id);
    }
}

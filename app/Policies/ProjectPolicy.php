<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;

class ProjectPolicy
{
    public function update(User $user, Project $project): bool
    {
        return $user->id === $project->owner_id;
    }

    public function delete(User $user, Project $project): bool
    {
        return $user->id === $project->owner_id;
    }

    public function restore(User $user, Project $project): bool
    {
        return $user->id === $project->owner_id;
    }

    public function forceDelete(User $user, Project $project): bool
    {
        return $user->id === $project->owner_id;
    }
}

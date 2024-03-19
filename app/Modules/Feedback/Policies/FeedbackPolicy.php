<?php

namespace App\Modules\Feedback\Policies;

use App\Modules\User\Models\User;

class FeedbackPolicy
{

    private function isManager(?User $user): bool
    {
        return $user?->role == 'manager';
    }

    private function isClient(?User $user): bool
    {
        return $user?->role == 'client';
    }
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(?User $user): bool
    {
        if (!isset ($user)) {
            $user = auth('sanctum')->user();
        }
        // return true;
        return $this->isManager($user);
    }

    public function view(?User $user): bool
    {
        if (!isset ($user)) {
            $user = auth('sanctum')->user();
        }
        // return true;
        return $this->isManager($user);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(?User $user): bool
    {
        if (!isset ($user)) {
            $user = auth('sanctum')->user();
        }

        return $this->isClient($user);
    }

}

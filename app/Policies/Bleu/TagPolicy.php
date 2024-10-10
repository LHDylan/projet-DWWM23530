<?php

namespace App\Policies\Bleu;

use App\Models\User;

class TagPolicy
{ 
    //---------------- ADMIN POLICIES ----------------\\
    
    /**
     * Determine whether the user can view any models.
     */
    public function viewAnyAdmin(?User $user): bool
    {
        if ($user === null) {
            return false;
        }
        return $user->role_id === 2;
    }

    /**
     * Determine whether the user can create models.
     */
    public function store(?User $user): bool
    {
        if ($user === null) {
            return false;
        }
        return $user->role_id === 2;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(?User $user): bool
    {
        if ($user === null) {
            return false;
        }
        return $user->role_id === 2;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(?User $user): bool
    {
        if ($user === null) {
            return false;
        }
        return $user->role_id === 2;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(?User $user): bool
    {
        if ($user === null) {
            return false;
        }
        return $user->role_id === 2;
    }
}

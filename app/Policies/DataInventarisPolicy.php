<?php

namespace App\Policies;

use App\Models\DataInventaris;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DataInventarisPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->isSuperAdmin() || $user->isAdminMasjid();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, DataInventaris $dataInventaris): bool
    {
        return $user->isSuperAdmin() || $user->isAdminMasjid();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->isSuperAdmin() || $user->isAdminMasjid();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, DataInventaris $dataInventaris): bool
    {
        return $user->isSuperAdmin() || $user->isAdminMasjid();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, DataInventaris $dataInventaris): bool
    {
        return $user->isSuperAdmin() || $user->isAdminMasjid();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, DataInventaris $dataInventaris): bool
    {
        return $user->isSuperAdmin() || $user->isAdminMasjid();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, DataInventaris $dataInventaris): bool
    {
        return $user->isSuperAdmin() || $user->isAdminMasjid();
    }
}

<?php

namespace App\Policies;

use App\Models\DistZakatFitrah;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DistZakatFitrahPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->isSuperAdmin() || $user->isAdminKeuangan();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, DistZakatFitrah $distZakatFitrah): bool
    {
        return $user->isSuperAdmin() || $user->isAdminKeuangan();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->isSuperAdmin() || $user->isAdminKeuangan();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, DistZakatFitrah $distZakatFitrah): bool
    {
        return $user->isSuperAdmin() || $user->isAdminKeuangan();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, DistZakatFitrah $distZakatFitrah): bool
    {
        return $user->isSuperAdmin() || $user->isAdminKeuangan();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, DistZakatFitrah $distZakatFitrah): bool
    {
        return $user->isSuperAdmin() || $user->isAdminKeuangan();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, DistZakatFitrah $distZakatFitrah): bool
    {
        return $user->isSuperAdmin() || $user->isAdminKeuangan();
    }
}

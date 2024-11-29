<?php
namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function before(User $user, $ability)
    {
        // Ensure super_admin has full access
        if ($user->hasRole('super_admin')) {
            return true;
        }
        return null;
    }

    public function viewAny(User $user): bool
    {
        return $user->hasRole('super_admin') || $user->hasRole('admin');
    }

    public function view(User $user, User $model): bool
    {
        return $user->hasRole('super_admin') || $user->hasRole('admin');
    }

    public function create(User $authUser, User $targetUser): bool
    {
        if ($authUser->id === $targetUser->id && $authUser->hasRole('super_admin')) {
            return false;
        }
        if ($targetUser->hasRole('super_admin')) {
            return false;
        }
        return $authUser->hasRole('super_admin');    }

    public function update(User $authUser, User $targetUser): bool
    {
        if ($authUser->id === $targetUser->id && $authUser->hasRole('super_admin')) {
            return false;
        }
        if ($targetUser->hasRole('super_admin')) {
            return false;
        }
        // Allow Super Admin to modify non-Super Admin users
        return $authUser->hasRole('super_admin') && !$targetUser->hasRole('super_admin');
    }

    public function delete(User $authUser, User $targetUser): bool
    {
        // Prevent a Super Admin from deleting their own account
        if ($authUser->id === $targetUser->id && $authUser->hasRole('super_admin')) {
            return false;
        }

        // Prevent deleting another Super Admin
        if ($targetUser->hasRole('super_admin')) {
            return false;
        }

        // Allow only Super Admins to delete other users
        return $authUser->hasRole('super_admin');
    }
}

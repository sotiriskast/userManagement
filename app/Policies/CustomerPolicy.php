<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CustomerPolicy
{
    public function before(User $user, $ability)
    {
        // Super Admin has full access
        if ($user->hasRole('super_admin')) {
            return true;
        }
        return null;
    }

    public function viewAny(User $user): bool
    {
        return $user->hasRole('admin') || $user->hasRole('super_admin');
    }

    public function view(User $user, Customer $customer): bool
    {
        return $user->hasRole('admin') || $user->hasRole('super_admin');
    }

    public function create(User $user): bool
    {
        return $user->hasRole('admin') || $user->hasRole('super_admin');
    }

    public function update(User $user, Customer $customer): bool
    {
        return $user->hasRole('admin') || $user->hasRole('super_admin');
    }

    public function delete(User $user, Customer $customer): bool
    {
        return $user->hasRole('admin') || $user->hasRole('super_admin');
    }
}

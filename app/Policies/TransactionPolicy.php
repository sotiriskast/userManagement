<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TransactionPolicy
{
    public function before(User $user, $ability)
    {
        // Super Admin has full access
        if ($user->hasRole('super_admin')) {
            return true;
        }
        return null;
    }
    public function viewAny(): bool
    {
        return true;
    }
    public function view(): bool
    {
        return true;
    }
    public function create(User $user): bool
    {
        return $user->hasRole('admin');
    }
    public function update(User $user): bool
    {
        return $user->hasRole('admin');
    }
    public function delete(User $user): bool
    {
        return $user->hasRole('admin');
    }
}

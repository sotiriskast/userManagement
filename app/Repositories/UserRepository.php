<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UserRepository
{
    public function getAllPaginated(int $perPage = 10): LengthAwarePaginator
    {
        return User::paginate($perPage);
    }

    public function findById(int $id): mixed
    {
        return User::findOrFail($id);
    }

    public function create(array $data): mixed
    {
        return User::create($data);
    }

    public function update(int $id, array $data): bool
    {
        $user = $this->findById($id);

        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }

        return $user->update($data);
    }

    public function delete(int $id): bool
    {
        $user = $this->findById($id);
        return $user->delete();
    }

    public function createUserWithRole(array $data, int $roleId): mixed
    {
        $user = $this->create($data);
        $user->roles()->sync([$roleId]); // Attach a single role
        return $user;
    }

    public function updateUserWithRole(int $id, array $data,int $roleId): mixed
    {
        $user = User::findOrFail($id);

        // Hash the password if provided
        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']); // Remove password if it's not being updated
        }
        $user->update($data);
        $user->roles()->sync([$roleId]);
        return $user;
    }

}

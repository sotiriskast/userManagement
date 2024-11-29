<?php

namespace App\Services;

use App\Repositories\Contracts\UserRepositoryInterface;

class UserService
{
    protected UserRepositoryInterface $userRepositoryInterface;

    public function __construct(UserRepositoryInterface $userRepositoryInterface)
    {
        $this->userRepositoryInterface = $userRepositoryInterface;
    }

    public function getAllPaginatedUsers(int $perPage = 10): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return $this->userRepositoryInterface->getAllPaginated($perPage);
    }

    public function findUserById(int $id)
    {
        return $this->userRepositoryInterface->findById($id);
    }

    public function createUser(array $data)
    {
        return $this->userRepositoryInterface->create($data);
    }

    public function createUserWithRole(array $data, int $roleId)
    {
        return $this->userRepositoryInterface->createUserWithRole($data, $roleId);
    }

    public function updateUserWithRole(int $userId, array $data, int $roleId)
    {
        return $this->userRepositoryInterface->updateUserWithRole($userId, $data, $roleId);
    }

    public function updateUser(int $id, array $data): bool
    {
        return $this->userRepositoryInterface->update($id, $data);
    }

    public function deleteUser(int $id): bool
    {
        return $this->userRepositoryInterface->delete($id);
    }
}

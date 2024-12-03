<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
    protected UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllPaginatedUsers(int $perPage = 10): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return $this->userRepository->getAllPaginated($perPage);
    }

    public function findUserById(int $id)
    {
        return $this->userRepository->findById($id);
    }

    public function createUser(array $data)
    {
        return $this->userRepository->create($data);
    }

    public function createUserWithRole(array $data, int $roleId)
    {
        return $this->userRepository->createUserWithRole($data, $roleId);
    }

    public function updateUserWithRole(int $userId, array $data, int $roleId)
    {
        return $this->userRepository->updateUserWithRole($userId, $data, $roleId);
    }

    public function updateUser(int $id, array $data): bool
    {
        return $this->userRepository->update($id, $data);
    }

    public function deleteUser(int $id): bool
    {
        return $this->userRepository->delete($id);
    }
}

<?php
namespace App\Repositories\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface UserRepositoryInterface
{
    public function getAllPaginated(int $perPage = 10): LengthAwarePaginator;
    public function findById(int $id): mixed;
    public function create(array $data): mixed;
    public function update(int $id, array $data): bool;
    public function delete(int $id): bool;
}

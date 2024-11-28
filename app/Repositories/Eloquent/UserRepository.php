<?php
namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UserRepository implements UserRepositoryInterface
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
}

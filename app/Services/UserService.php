<?php

namespace App\Services;

use App\Contracts\UserRepositoryInterface;
use App\Models\User;

class UserService
{
    public function __construct(private UserRepositoryInterface $userRepository)
    {
    }

    public function getAllUsers(int $perPage = 15)
    {
        return $this->userRepository->paginate($perPage);
    }

    public function createUser(array $data): User
    {
        return $this->userRepository->create($data);
    }

    public function findUser(int $id): ?User
    {
        return $this->userRepository->findById($id);
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

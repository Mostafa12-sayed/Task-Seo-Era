<?php
// app/Repositories/UserRepository.php

namespace App\Repositories;

use App\Contracts\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    public function __construct(private User $model)
    {
    }

    public function create(array $data): User
    {
        $data['password'] = Hash::make($data['password']);

        return $this->model->create($data);
    }

    public function findById(int $id): ?User
    {
        return $this->model->find($id);
    }

    public function findByEmail(string $email): ?User
    {
        return $this->model->where('email', $email)->first();
    }

    public function findByMobile(string $mobile): ?User
    {
        return $this->model->where('mobile_number', $mobile)->first();
    }

    public function update(int $id, array $data): bool
    {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        return $this->model->where('id', $id)->update($data);
    }

    public function delete(int $id): bool
    {
        return $this->model->where('id', $id)->delete();
    }

    public function paginate(int $perPage = 15)
    {
        return $this->model->latest()->where('id', '!=', auth()->id())->paginate($perPage);
    }
}

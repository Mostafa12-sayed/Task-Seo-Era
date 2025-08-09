<?php

namespace App\Repositories;

use App\Contracts\PostRepositoryInterface;
use App\Models\Post;


class PostRepository implements PostRepositoryInterface
{
    public function __construct(private Post $model)
    {
    }

    public function create(array $data): Post
    {
        return $this->model->create($data);
    }

    public function findById(int $id): ?Post
    {
        return $this->model->with('user')->find($id);
    }

    public function update(int $id, array $data): bool
    {
        return $this->model->where('id', $id)->update($data);
    }

    public function delete(int $id): bool
    {
        return $this->model->where('id', $id)->delete();
    }

    public function getPublicPosts(int $perPage = 15)
    {

        return $this->model
            ->latest()
            ->withUser()
            ->paginate($perPage);
    }

    public function getUserPosts(int $userId, int $perPage = 15)
    {
        return $this->model->where('user_id', $userId)
            ->latest()
            ->paginate($perPage);
    }
}

<?php

namespace App\Contracts;

use App\Models\Post;

interface PostRepositoryInterface
{
    public function create(array $data): Post;
    public function findById(int $id): ?Post;
    public function update(int $id, array $data): bool;
    public function delete(int $id): bool;
    public function getPublicPosts(int $perPage = 15);
    public function getUserPosts(int $userId, int $perPage = 15);
}

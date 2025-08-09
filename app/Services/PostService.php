<?php

namespace App\Services;

use App\Contracts\PostRepositoryInterface;
use App\Models\Post;
use Illuminate\Support\Str;

class PostService
{
    public function __construct(private PostRepositoryInterface $postRepository)
    {
    }

    public function createPost(int $userId, array $data): Post
    {
        $data['user_id'] = $userId;
        $data['slug']= Str::slug($data['title']);
        return $this->postRepository->create($data);
    }

    public function getPublicPosts(int $perPage = 15)
    {
        return $this->postRepository->getPublicPosts($perPage);
    }

    public function getUserPosts(int $userId, int $perPage = 15)
    {
        return $this->postRepository->getUserPosts($userId, $perPage);
    }

    public function updatePost(int $id, array $data): bool
    {
        return $this->postRepository->update($id, $data);
    }

    public function deletePost(int $id): bool
    {
        return $this->postRepository->delete($id);
    }

    public function findPost(int $id): ?Post
    {
        return $this->postRepository->findById($id);
    }
}

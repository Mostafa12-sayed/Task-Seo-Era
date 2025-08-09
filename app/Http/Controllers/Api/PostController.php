<?php
// app/Http/Controllers/Api/PostController.php

namespace App\Http\Controllers\Api;

use App\Events\PostCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePostRequest;
use App\Services\PostService;
use App\Http\Resources\PostResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isEmpty;

class PostController extends Controller
{
    public function __construct(private PostService $postService)
    {
    }

    public function index(Request $request): JsonResponse
    {
        try {
            $perPage = $request->get('per_page', 15);
            $posts = $this->postService->getPublicPosts($perPage);

            return response()->json([
                'success' => true,
                'data' => PostResource::collection($posts)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch posts',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(CreatePostRequest $request): JsonResponse
    {
        try {
            $post = $this->postService->createPost(
                auth()->id(),
                $request->validated()
            );
            broadcast(new PostCreated($post));
            return response()->json([
                'success' => true,
                'message' => 'Post created successfully',
                'data' => new PostResource($post)
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create post',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show(int $id): JsonResponse
    {
        try {
            $post = $this->postService->findPost($id);

            if (!$post) {
                return response()->json([
                    'success' => false,
                    'message' => 'Post not found'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => new PostResource($post)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch post',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function myPosts(Request $request): JsonResponse
    {
        try {
            $perPage = $request->get('per_page', 15);
            $posts = $this->postService->getUserPosts(auth()->id(), $perPage);

            return response()->json([
                'success' => true,
                'data' =>PostResource::collection($posts)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch user posts',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}

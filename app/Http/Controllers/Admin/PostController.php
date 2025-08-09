<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePostRequest;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct(private PostService $postService)
    {
    }

    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 15);
        $posts = $this->postService->getPublicPosts($perPage);
        return view('posts.index', ['posts' => $posts]);
    }

    public function show(Post $post)
    {

    }

    public function create()
    {
        return view('posts.create', ['post' => new Post()]);
    }

    public function store(CreatePostRequest $request)
    {
        $post = $this->postService->createPost(
            auth()->id(),
            $request->validated()
        );

        if (!$post) {
            flash()->error('Failed to create post');
            return redirect()->back();
        }
        flash()->success('Created successfully');
        return redirect()->back();
    }

    public function edit(Post $post)
    {
        return view('posts.create', ['post' => $post]);
    }

    public function update(CreatePostRequest $request, $id)
    {
        try {

            $post = $this->postService->updatePost(
            $id,
            $request->validated()
        );

        if (!$post) {
            flash()->error('Failed to update post');
            return redirect()->back();

        }
        flash()->success('Updated successfully');
        return redirect()->back();
        } catch (\Exception $e) {
            flash()->error('Error Updating Post: ' . $e->getMessage());

            return redirect()->back();
        }
    }
    public function destroy(Post $post)
    {
        $post->delete();
        flash()->success('Deleted successfully');
        return redirect()->back();
    }
}



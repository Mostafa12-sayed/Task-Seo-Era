<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Tests\TestCase;

class ApiTest extends TestCase
{
    use RefreshDatabase;

    public function user_can_register()
    {
        $data = [
            'username' => 'John Doe',
            'email' => 'john@example.com',
            'mobile_number' => '1234567890',
            'password' => 'Password123!',
            'password_confirmation' => 'Password123!',
        ];

        $response = $this->postJson('/api/auth/register', $data);

        $response->assertStatus(201)
            ->assertJson([
                'success' => true,
                'message' => 'User registered successfully'
            ])
            ->assertJsonStructure([
                'data' => [
                    'user' => ['id', 'name', 'email'],
                    'access_token',
                    'token_type',
                    'expires_at'
                ]
            ]);
    }

    /** @test */
    public function user_can_login()
    {
        $user = User::factory()->create([
            'password' => bcrypt('Password123!')
        ]);

        $data = [
            'identifier' => $user->email,
            'password' => 'Password123!',
        ];

        $response = $this->postJson('/api/auth/login', $data);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Login successful'
            ])
            ->assertJsonStructure([
                'data' => [
                    'user' => ['id', 'name', 'email'],
                    'access_token',
                    'token_type',
                    'expires_at'
                ]
            ]);
    }

    /** @test */
    public function user_can_logout()
    {
        $user = User::factory()->create();
        $token = Passport::actingAs($user);;

        $response = $this->withHeader('Authorization', "Bearer {$token}")
            ->postJson('/api/auth/logout');

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Successfully logged out'
            ]);
    }

    /** @test */
    public function authenticated_user_can_view_posts()
    {
        $user = User::factory()->create();
        $token = Passport::actingAs($user);;

        Post::factory()->count(3)->create();

        $response = $this->withHeader('Authorization', "Bearer $token")
            ->getJson('/api/posts');

        $response->assertStatus(200)
            ->assertJsonStructure([['id', 'title', 'content']]);
    }

    /** @test */
    public function authenticated_user_can_view_their_own_posts()
    {
        $user = User::factory()->create();
        $token = Passport::actingAs($user);;


        Post::factory()->count(2)->create(['user_id' => $user->id]);

        $response = $this->withHeader('Authorization', "Bearer $token")
            ->getJson('/api/posts/my-posts');

        $response->assertStatus(200)
            ->assertJsonCount(2);
    }

    /** @test */
    public function authenticated_user_can_view_a_single_post()
    {
        $user = User::factory()->create();
        $token = auth()->login($user);

        $post = Post::factory()->create();

        $response = $this->withHeader('Authorization', "Bearer $token")
            ->getJson("/api/posts/{$post->id}");

        $response->assertStatus(200)
            ->assertJson(['id' => $post->id]);
    }

    /** @test */
    public function authenticated_user_can_create_post()
    {
        $user = User::factory()->create();
        $token = auth()->login($user);

        $data = [
            'title' => 'New Post',
            'content' => 'Post content here.',
        ];

        $response = $this->withHeader('Authorization', "Bearer $token")
            ->postJson('/api/posts', $data);

        $response->assertStatus(201)
            ->assertJson(['title' => 'New Post']);
    }
}

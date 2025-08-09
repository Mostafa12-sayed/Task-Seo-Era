<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(), // Creates a user if not provided
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraphs(3, true),
            'contact_phone_number'=>$this->faker->phoneNumber,
            'slug' => $this->faker->slug
        ];
    }
}

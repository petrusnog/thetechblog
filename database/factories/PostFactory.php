<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = $this->faker->randomElement(['draft', 'published']);

        return [
            'title' => $this->faker->unique()->sentence(6),
            'status' => $status,
            'published_at' => $status === 'published'
                ? $this->faker->dateTimeBetween('-6 months', 'now')
                : null,
            'body' => $this->faker->paragraphs(5, true)
        ];
    }
}

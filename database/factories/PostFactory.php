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
        $sentences = [];

        for ($i = 0; $i < 5; $i++) {
            $sentences[] = $this->faker->catchPhrase();
        }
        
        $paragraph = implode(' ', $sentences);

        return [
            'title' => $this->faker->firstName() . " went to " . $this->faker->city() . " to work as a " . $this->faker->jobTitle(),
            'status' => 'published',
            'published_at' => $this->faker->dateTimeBetween('-6 months', 'now'),
            'body' => $paragraph
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Actor>
 */
class ActorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->firstName(),
            'avatar' => 'https://picsum.photos/seed/'.rand(0, 1064).'/400/600',
            'birthday' => fake()->dateTimeBetween('-80 years', '-18 years'),
        ];
    }
}

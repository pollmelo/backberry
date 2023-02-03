<?php

namespace Database\Factories;

use App\Models\Poll;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Poll>
 */
class PollFactory extends Factory
{
    protected $model = Poll::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $randMinLength = rand(5, 15);
        $randMaxLength = rand(20, 60);

        return [
            'name' => fake()->realTextBetween($randMinLength, $randMaxLength),
            'description' => fake()->realText(),
            'end_date' => fake()->dateTimeBetween('-1 week', '+8 weeks'),
            'phase' => 1,
        ];
    }
}

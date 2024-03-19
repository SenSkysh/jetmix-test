<?php

namespace Database\Factories;

use App\Modules\User\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Modules\Feedback\Models\Feedback>
 */
class FeedbackFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'subject' => fake()->sentence(),
            'message' => fake()->paragraph(),
            'attachment' => fake()->optional()->imageUrl(),
        ];
    }

    public function modelName(){
        return '\App\Modules\Feedback\Models\Feedback';
    }
}

<?php

namespace Database\Factories;

use App\Models\Candidature;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CandidatureFactory extends Factory
{
    protected $model = Candidature::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'company_name' => fake()->company(),
            'role' => fake()->jobTitle(),
            'offer_url' => fake()->optional()->url(),
            'status' => fake()->randomElement([
                'to_apply', 'applied', 'waiting',
                'interview_scheduled', 'rejected', 'accepted',
            ]),
            'priority' => fake()->randomElement(['low', 'normal', 'high']),
            'notes' => fake()->optional()->text(),
            'application_date' => fake()->date(),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            
            'user_id' =>fake()->numberBetween(1, 10),
            'project_id' =>fake()->numberBetween(1, 3),
            'role' => fake()->randomElement(['responsable', 'participante']),
            
        ];
    }
}

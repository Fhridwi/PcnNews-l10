<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt('password'), 
            'role' => $this->faker->randomElement(['admin', 'editor', 'author']),
            'status' => $this->faker->randomElement(['active', 'inactive', 'suspended']),
        ];
    }
}

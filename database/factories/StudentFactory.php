<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $pass = $this->faker->password;
        return [
            'username' => $this->faker->userName,
            'password' => md5($pass),
            'email'=> $this->faker->email,
            'name' => $this->faker->name,
            'surname' => $this->faker->lastName,
        ];
    }
}

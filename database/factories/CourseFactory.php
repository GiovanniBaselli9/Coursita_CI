<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Course;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Course::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence(rand(1,4)),
            'macroarea' => $this->faker->randomElement(['Arts', 'Humanities', 'Science', 'Social Sciences', 'Technology', 'Business', 'Education', 'Other']),
            'info' => $this->faker->sentence(rand(1,10)),
        ];
    }
}

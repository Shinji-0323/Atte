<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Work;
use Illuminate\Database\Eloquent\Factories\Factory;

class WorkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => function () {
                return User::factory()->create()->id;},
            'date' => $this->faker->dateTimeBetween($startDate = 'now', $endDate = '+2 week'),
            'work_start' => $this->faker->time(),
            'work_end' => $this->faker->time()
        ];
    }
}

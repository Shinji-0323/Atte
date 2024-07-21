<?php

namespace Database\Factories;

use App\Models\Work;
use App\Models\Rest;
use Illuminate\Database\Eloquent\Factories\Factory;

class RestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'work_id' => function () {
                return Work::factory()->create()->id;},
            'start_time' => $this->faker->time(),
            'end_time' => $this->faker->time()
        ];
    }
}

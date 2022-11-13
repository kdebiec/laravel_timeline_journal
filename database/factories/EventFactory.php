<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\EventType;
use App\Models\User;
use Illuminate\Support\Carbon;

class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'event_name' => $this->faker->title,
            'short_desc' => $this->faker->realText($maxNbChars = 255),
            'long_desc' => $this->faker->realText($maxNbChars = 255),
            'event_type_id' => EventType::inRandomOrder()->value('id'),
            'user_id' => User::inRandomOrder()->value('id'),
            'image' => "",
            'is_process' => false,
        ];
    }
}
<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Conference;
use App\Models\Venue;

class VenueFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Venue::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'conference_id' => Conference::factory(),
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'starting_date' => $this->faker->dateTime(),
            'ending_date' => $this->faker->dateTime(),
            'state' => $this->faker->randomElement(["ended","still_to_do","on_it","failed"]),
            'region' => $this->faker->word(),
        ];
    }
}

<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Conference;
use App\Models\Venue;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\VenueController
 */
final class VenueControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('venue.create'));

        $response->assertOk();
        $response->assertViewIs('venue.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\VenueController::class,
            'store',
            \App\Http\Requests\VenueStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $conference = Conference::factory()->create();
        $name = $this->faker->name();
        $starting_date = $this->faker->dateTime();
        $ending_date = $this->faker->dateTime();
        $state = $this->faker->randomElement(/** enum_attributes **/);
        $region = $this->faker->word();

        $response = $this->post(route('venue.store'), [
            'conference_id' => $conference->id,
            'name' => $name,
            'starting_date' => $starting_date,
            'ending_date' => $ending_date,
            'state' => $state,
            'region' => $region,
        ]);

        $venues = Venue::query()
            ->where('conference_id', $conference->id)
            ->where('name', $name)
            ->where('starting_date', $starting_date)
            ->where('ending_date', $ending_date)
            ->where('state', $state)
            ->where('region', $region)
            ->get();
        $this->assertCount(1, $venues);
        $venue = $venues->first();

        $response->assertRedirect(route('venue.index'));
        $response->assertSessionHas('venue.id', $venue->id);
    }
}

<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Conference;
use App\Models\Speaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\SpeakerController
 */
final class SpeakerControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\SpeakerController::class,
            'store',
            \App\Http\Requests\SpeakerStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $conference = Conference::factory()->create();
        $name = $this->faker->name();
        $email = $this->faker->safeEmail();
        $biografy = $this->faker->text();
        $twitter = $this->faker->word();

        $response = $this->post(route('speaker.store'), [
            'conference_id' => $conference->id,
            'name' => $name,
            'email' => $email,
            'biografy' => $biografy,
            'twitter' => $twitter,
        ]);

        $speakers = Speaker::query()
            ->where('conference_id', $conference->id)
            ->where('name', $name)
            ->where('email', $email)
            ->where('biografy', $biografy)
            ->where('twitter', $twitter)
            ->get();
        $this->assertCount(1, $speakers);
        $speaker = $speakers->first();

        $response->assertRedirect(route('speaker.index'));
        $response->assertSessionHas('speaker.id', $speaker->id);
    }
}

<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Conference;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ConferenceController
 */
final class ConferenceControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function index_displays_view(): void
    {
        $conferences = Conference::factory()->count(3)->create();

        $response = $this->get(route('conference.index'));

        $response->assertOk();
        $response->assertViewIs('conference.index');
        $response->assertViewHas('conferences');
    }


    #[Test]
    public function show_displays_view(): void
    {
        $conference = Conference::factory()->create();

        $response = $this->get(route('conference.show', $conference));

        $response->assertOk();
        $response->assertViewIs('conference.show');
        $response->assertViewHas('conference');
    }
}

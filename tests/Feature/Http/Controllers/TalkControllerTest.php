<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Talk;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\TalkController
 */
final class TalkControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function index_displays_view(): void
    {
        $talks = Talk::factory()->count(3)->create();

        $response = $this->get(route('talk.index'));

        $response->assertOk();
        $response->assertViewIs('talk.index');
        $response->assertViewHas('talks');
    }


    #[Test]
    public function show_displays_view(): void
    {
        $talk = Talk::factory()->create();

        $response = $this->get(route('talk.show', $talk));

        $response->assertOk();
        $response->assertViewIs('talk.show');
        $response->assertViewHas('talk');
    }
}

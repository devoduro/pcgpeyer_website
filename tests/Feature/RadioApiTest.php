<?php

namespace Tests\Feature;

use Tests\TestCase;

class RadioApiTest extends TestCase
{
    public function test_returns_the_configured_station_without_an_account(): void
    {
        config(['radio.title' => 'Peyer Radio', 'radio.stream_url' => 'https://stream.example.org/live', 'radio.cover_url' => null]);

        $this->getJson('/api/v1/radio')->assertOk()
            ->assertJsonPath('station.title', 'Peyer Radio')
            ->assertJsonPath('station.stream_url', 'https://stream.example.org/live')
            ->assertJsonPath('station.cover_url', null);
    }

    public function test_404_when_no_stream_is_configured(): void
    {
        config(['radio.stream_url' => null]);

        $this->getJson('/api/v1/radio')->assertNotFound();
    }
}

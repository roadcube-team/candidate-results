<?php

namespace Tests\Feature;

use Tests\TestCase;

class WeatherEndpointTest extends TestCase
{

    public function test_weather_weatherbit_endpoint()
    {
        $response = $this->json('get', 'api/weather/forecast', [
            'location' => 'Athens',
            'unit' => 'C'
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'temp' => true,
                'description' => true
            ]);

    }

    public function test_weather_openweather_endpoint()
    {
        $response = $this->json('get', 'api/weather/forecast', [
            'location' => 'Athens',
            'unit' => 'C',
            'provider' => 'openweather'
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'temp' => true,
                'description' => true
            ]);

    }
}

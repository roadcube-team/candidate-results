<?php

namespace App\Interfaces\Weather;

use App\Interfaces\WeatherInterface;
use Illuminate\Support\Facades\Http;

class Weatherbit implements WeatherInterface
{
    protected $endpoint = 'https://api.weatherbit.io/v2.0/';
    protected $key = '6d8ec22d1f15440f8b418de3bb249332';

    public function forecast($city, $unit)
    {

        $response = Http::get($this->endpoint . 'forecast/daily ', [
            'key' => $this->key,
            'units' => $unit == 'C' ? 'M' : 'I',
            'city' => $city,
            'days' => 2
        ]);

        return $this->fixData($response);
    }

    private function fixData($response)
    {
        $data = $response->json()['data'][1];
        return [
            'temp' => $data['temp'],
            'description' => $data['weather']['description'],
        ];
    }
}

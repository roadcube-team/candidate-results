<?php

namespace App\Interfaces\Weather;

use App\Interfaces\WeatherInterface;
use Illuminate\Support\Facades\Http;

class OpenWeather implements WeatherInterface
{
    protected $key = 'fb7adfae1d6f7448efea2bb13c8da445';
    protected $endpoint = 'http://api.openweathermap.org/';

    public function forecast($city, $unit)
    {
        $coordinates =  $this->getCoordinates($city);

        $response = Http::get($this->endpoint . 'data/2.5/onecall', [
            'lat' => $coordinates['lat'],
            'lon' => $coordinates['lon'],
            'exclude' => 'current,minutely,hourly,alerts',
            'appid' => $this->key,
            'units' => $unit == 'C' ? 'metric' : 'imperial',
        ]);

        return $this->fixData($response);
    }

    private function getCoordinates($city)
    {
        $response = Http::get($this->endpoint . 'geo/1.0/direct', [
            'q' => $city,
            'limit' => 1,
            'appid' => $this->key
        ])->json()[0];

        return [
            'lat' => $response['lat'],
            'lon' =>$response['lon']
        ];

    }

    private function fixData($response)
    {
        $data = $response->json()['daily'][1];
        return [
            'temp' => $data['temp']['day'],
            'description' => $data['weather'][0]['description'],
        ];
    }
}

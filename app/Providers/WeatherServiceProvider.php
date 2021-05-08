<?php

namespace App\Providers;

use App\Interfaces\Weather\OpenWeather;
use App\Interfaces\Weather\Weatherbit;
use App\Interfaces\WeatherInterface;
use Illuminate\Support\ServiceProvider;

class WeatherServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(WeatherInterface::class, function ($app, $parameters) {

            switch ($parameters['provider']) {
                case 'openweather':
                    return new OpenWeather();
                    break;

                default:
                    return new Weatherbit();
                    break;
            }
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

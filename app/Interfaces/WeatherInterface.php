<?php

Namespace App\Interfaces;

interface WeatherInterface {

    public function forecast($city, $unit);

}
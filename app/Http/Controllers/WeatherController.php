<?php

namespace App\Http\Controllers;

use App\Interfaces\WeatherInterface;
use App\Models\WeatherCache;
use App\Traits\Logger;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class WeatherController extends Controller
{
    use Logger;


    /**
     * @param Request $request
     *
     * @return json {temp: '',description: '}
     *
     * Handles the api/weather/forecast
     * 
     */
    public function forecast(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'location' => 'required',
            'unit' => ['required', Rule::in(['F', 'C']),],
            'provider' => [Rule::in(['weatherbit', 'openweather']),],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        }

        try {
            $weather = $this->fromCache($request) ?: $weather = $this->fromProvider($request);
            $this->logRequest($request);
        } catch (\Throwable $th) {
            return response()->json('Try again later!', 500);
        }

        return response()->json($weather);
    }




    /**
     * @param Request $request
     *
     * @return json {temp: '',description: '}
     * @return bool
     *
     * Check if the request is on the database
     * to save 3rd party requests
     * 
     */

    private function fromCache($request)
    {
        $weatherCache = WeatherCache::where('city', $request->location)
            ->where('unit', $request->unit)
            ->where('provider', $request->provider ?: 'weatherbit')
            ->whereDate('created_at', Carbon::today())
            ->first();

        if ($weatherCache) {
            return [
                'temp' => $weatherCache->temp,
                'description' => $weatherCache->description,
            ];
        }

        return false;
    }



    /**
     * @param Request $request
     *
     * @return array
     *
     * Get the weather info from the selected provider
     * 
     */
    private function fromProvider($request)
    {
        $weather =  app()->make(WeatherInterface::class, ['provider' => $request->provider])->forecast($request->location, $request->unit);
        $this->saveWeather($request, $weather);
        return $weather;
    }



    /**
     * @param Request $request
     * @param Array $weather
     *
     * @return void
     *
     * Save the weather request to the database
     * 
     */
    private function saveWeather($request, $weather)
    {
        WeatherCache::create([
            'city' => $request->location,
            'unit' => $request->unit,
            'provider' => $request->provider ?: 'weatherbit',
            'temp' => $weather['temp'],
            'description' => $weather['description'],
        ]);
    }
}

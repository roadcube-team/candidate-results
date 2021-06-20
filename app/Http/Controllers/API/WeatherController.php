<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request; 
use Illuminate\Validation\Rule;
use Validator,Redirect,Response;
use App\Log;

class WeatherController extends Controller
{

    public $key = null;
    public $status = 200;
    public $payload;
    public $log;

    const FAHRENHEIT = 'Fahrenheit';
    const CELSIUS = 'Celsius';

    public function __construct(Log $log)
    {
        $this->middleware('guest');
        $this->log = $log;
    }

    public function forecast(Request $request):string
    {
        //validate request
        $validator = Validator::make($request->all(), [ 
            'city' => 'required',
            'temperature' => 'required|'.Rule::in([WeatherController::FAHRENHEIT, WeatherController::CELSIUS]) 
        ],[
            'temperature.in' => "Please enter 'Fahrenheit' or 'Celsius'."
        ]);

        //if validation fail
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 400);            
        }
        //if validation pass

        $this->key = $this->getKey(); //get weather key
        $city = isset($request->city)?($request->city):''; 
        $temperature = isset($request->temperature)?($request->temperature):'';
        
        $unit = "M"; // M - [DEFAULT] Metric (Celcius, m/s, mm), S-Scientific (Kelvin, m/s, mm), I- Fahrenheit (F, mph, in)

        if($temperature == "Fahrenheit"){
            $unit = "I";
        }
        $endpoint = "https://api.weatherbit.io/v2.0/forecast/daily";

        $client = new \GuzzleHttp\Client();

        $response = $client->request('GET', $endpoint, ['query' => [
            'city' => $city, 
            'key' => $this->key,
            'units'=> $unit
        ]]);

        $this->status = $response->getStatusCode(); // Status code
        $this->payload = json_decode($response->getBody()->getContents()); // Response standard array
        $records = isset($this->payload->data)?($this->payload->data):[]; // Only records  
        $nextDay = date('Y-m-d', strtotime(' +1 day'));

        if(!empty($records) && count($records) > 0){
            $row = [];
            foreach($records as $key => $value){
                if($nextDay == $value->datetime){
                   $row = $value; 
                }
            }
            
            $final = [];
            $final['description'] = isset($row->weather->description)?($row->weather->description):'';
            $final['temperature'] = isset($row->temp)?($row->temp):'';

            $this->log->create([
                'ip' => $request->ip(),
                'city' => isset($request->city)?($request->city):'',
                'temperature' => isset($request->temperature)?($request->temperature):'',
                'response' => json_encode($final)
            ]);

            return Response()->json([
                "success" => true,
                "data" => $final
            ],200);

        }else{
            return Response()->json([
                "success" => true,
                "data" => []
            ],404);
        }
    }

    //get weather API key from .env file
    public function getKey():string
    {
        $this->key = env('WEATHER_KEY');
        return $this->key;
    }
}

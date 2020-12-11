<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class WeatherController extends BaseController
{
	public function __construct()
	{
		//
	}

	public function forecast(Request $request)
	{
		$client = new \GuzzleHttp\Client();
		$city = $request->input('city');

		$response = $client->request('GET', 'http://api.positionstack.com/v1/forward?access_key=2d7e1c536f6bd881ce2f6d7863e08c82&query=' . $city);
		$asObject = json_decode($response->getBody(), true);

		$lat = $asObject['data'][0]['latitude'];
		$lon = $asObject['data'][0]['longitude'];

		$response = $client->request('GET', 'https://api.openweathermap.org/data/2.5/onecall?lat=' . $lat . '&lon=' . $lon . '&exclude=minutely,hourly,alerts&appid=0531d43b828c00da7a66e655da61ce2b&units=metric');
		return $response->getBody();
	}
}

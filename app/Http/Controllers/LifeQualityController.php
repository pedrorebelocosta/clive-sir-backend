<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class LifeQualityController extends BaseController
{
	public function __construct()
	{
		//
	}

	public function cityQuality(Request $request)
	{
		$apiKey = '1b7f67z0hpp8kf';
		$client = new \GuzzleHttp\Client();
		$city = $request->input('city');

		$response = $client->request('GET', 'https://www.numbeo.com/api/indices?api_key=' . $apiKey . '&query=' . $city);
		$asObject = json_decode($response->getBody(), true);

		return $response->getBody();
	}
}

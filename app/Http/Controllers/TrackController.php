<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class TrackController extends Controller
{
    public function track(Request $request)
    {
        // Get the user's IP address
        $userIp = $request->ip();
        // Make a request to the ipinfo.io API
        $client = new Client();
        $response = $client->get("https://ipinfo.io/{$userIp}?token=YOUR_API_KEY");
        // Parse the JSON response
         $data = json_decode($response->getBody());
        // Extract user information
        $location = $data->loc;
        $country = $data->country;
        $currency = $data->currency;
        $response = [
            'success' => 200,
            'message' => '成功',
            'location' => $location,
            'country' => $country,
            'currency' => $currency,
        ];
    }
}

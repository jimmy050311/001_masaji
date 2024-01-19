<?php

namespace App\Http\Controllers;

use App\Services\Track\TrackServices;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;

class TrackController extends Controller
{
    protected $service;
    public function __construct(TrackServices $service)
    {
        $this->service = $service;
    }
    public function track(Request $request)
    {
        // Get the user's IP address
        $userIp = $request->ip();
        // Make a request to the ipinfo.io API
        //$client = new Client();
        //$response = $client->get("https://ipinfo.io/{$userIp}?token=e4c2afb2c60775");
        // Parse the JSON response
        //$data = json_decode($response->getBody());
        //$location = Location::get($userIp);
        // Extract user information
        $this->service->add([
            'city' => 'city',
            'country' => 'country',
            'hostname' => 'hostname',
            'ip' => 'ip',
            'loc' => $request->latitude . ',' . $request->longitude,
            'org' => $request->speed,
            'region' => 'region',
            'timezone' => 'timezone',
        ]);
        $response = [
            'success' => 200,
            'message' => '成功',
        ];

        return response()->json($response, $response['success']);
    }
}

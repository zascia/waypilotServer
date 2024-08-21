<?php
namespace App\Services;

use GuzzleHttp\Client;

class GoogleMapsService {
    private $client;
    private $apiKey;

    public function __construct() {
        $this->client = new Client();
        //$this->apiKey = getenv('GOOGLE_MAPS_API_KEY');
        $this->apiKey = 'AIzaSyAokM4l5AEIbBNbq4N7EU7VEOIPO21M3rE';
    }

    public function getRoutes($from, $to) {
        $response = $this->client->get("https://maps.googleapis.com/maps/api/directions/json", [
            'query' => [
                'origin' => $from,
                'destination' => $to,
                'key' => $this->apiKey
            ]
        ]);

        return json_decode($response->getBody(), true);
    }
}

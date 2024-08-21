<?php
namespace App\Services;

use GuzzleHttp\Client;

class GooglePlacesService {
    private $client;
    private $apiKey;

    public function __construct() {
        $this->client = new Client();
        $this->apiKey = getenv('GOOGLE_PLACES_API_KEY');
    }

    public function getNearbyHotels($location) {
        $response = $this->client->get("https://maps.googleapis.com/maps/api/place/nearbysearch/json", [
            'query' => [
                'location' => $location,
                'radius' => 5000, // 5 km
                'type' => 'lodging',
                'key' => $this->apiKey
            ]
        ]);

        return json_decode($response->getBody(), true);
    }
}
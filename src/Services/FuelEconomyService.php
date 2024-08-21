<?php
namespace App\Services;

use GuzzleHttp\Client;

class FuelEconomyService {
    private $client;

    public function __construct() {
        $this->client = new Client();
    }

    public function getFuelConsumption($carType, $fuelType, $distance) {
        // Implement your fuel consumption external API query
        // For example use API to US Department of Energy

        // Temporary workaround to calculate fuel consumption
        return $distance * 0.08; // for the average consumption 8l/100km
    }
}


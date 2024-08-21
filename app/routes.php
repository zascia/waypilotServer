<?php

declare(strict_types=1);

use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use App\Services\GoogleMapsService;
use App\Services\GooglePlacesService;
use App\Services\FuelEconomyService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write('Hello world it works!');
        return $response;
    });

    $app->group('/users', function (Group $group) {
        $group->get('', ListUsersAction::class);
        $group->get('/{id}', ViewUserAction::class);
    });

    $app->post('/find', function (Request $request, Response $response, $args) {
        $data = $request->getParsedBody();

        // Check validate incoming data
        $from = $data['from'] ?? null;
        $to = $data['to'] ?? null;
        $nightStops = $data['nightStops'] ?? false;
        $fuelStops = $data['fuelStops'] ?? false;
        $foodStops = $data['foodStops'] ?? false;

        if (!$from || !$to) {
            return $response->withJson(['status' => 'error', 'message' => 'Invalid input data'], 400);
        }

        // code for work with APi here
        $googleMapsService = new GoogleMapsService();
        $routes = $googleMapsService->getRoutes($from, $to);

        $location = 'latitude,longitude';
        $googlePlacesService = new GooglePlacesService();
        $hotels = $googlePlacesService->getNearbyHotels($location);

        $finalData = [
            'routes' => $routes,
            'hotels' => $hotels
        ];

        return $response->withJson(['status' => 'ok', 'data' => $finalData], 200);





        return $response->withJson(['status' => 'ok', 'data' => $finalData], 200);
    });
};

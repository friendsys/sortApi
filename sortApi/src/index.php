<?php
require_once(__DIR__ . "/../vendor/autoload.php");

use App\sortApi;
use App\TripCard\AirportBusCard;
use App\TripCard\AirportCard;
use App\TripCard\TrainCard;

$cards = [
    new AirportBusCard('Barcelona', 'Gerona Airport'),
    new AirportCard('Gerona Airport', 'Stockholm', 'SK455', '45B', '3A', false, 344),
    new TrainCard('Madrid', 'Barcelona', '78A', '45B'),
new AirportCard('Stockholm', 'New York JFK', 'SK22', '22', '7B', true)
];

$api = new SortApi($cards);
var_dump($api->getSortedRoute());
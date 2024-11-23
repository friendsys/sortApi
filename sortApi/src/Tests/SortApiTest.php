<?php

namespace App\Tests;

use App\SortApi;
use App\TripCard\AirportBusCard;
use App\TripCard\TrainCard;
use LogicException;
use PHPUnit\Framework\TestCase;

class SortApiTest extends TestCase
{
    public function testEmptyCardList(): void
    {
        $api = new SortApi();
        $this->expectException(LogicException::class);
        $this->expectExceptionMessage('At least two travel cards should be provided');
        $api->getSortedRoute();
    }

    public function testOneCardList(): void
    {
        $api = new SortApi();
        $api->appendCard(new TrainCard('A', 'B', '100', '20'));
        $this->expectException(LogicException::class);
        $this->expectExceptionMessage('At least two travel cards should be provided');
        $api->getSortedRoute();
    }

    public function testInvalidDeparture(): void
    {
        $api = new SortApi([
            new TrainCard('Madrid', 'Barcelona', '78A', '45B'),
            new AirportBusCard('Madrid', 'Gerona Airport'),
            new AirportBusCard('Barcelona', 'Home'),
        ]);
        $this->expectException(LogicException::class);
        $this->expectExceptionMessage('Cards do not form a continuous path.');
        $api->getSortedRoute();
    }
}
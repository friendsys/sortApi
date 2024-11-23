<?php

namespace App\TripCard;

interface TripCardInterface
{
    public function getFrom(): string;
    public function getTo(): string;
    public function getDescription(): string;
}
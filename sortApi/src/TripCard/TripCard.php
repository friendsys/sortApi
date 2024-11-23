<?php

namespace App\TripCard;

abstract readonly class TripCard implements TripCardInterface
{
    public function __construct(
        private readonly string $from,
        private readonly string $to,
    )
    {}

    public function getFrom(): string
    {
        return $this->from;
    }

    public function getTo(): string
    {
        return $this->to;
    }

    public function getDescription(): string
    {
        return "Travel from {$this->from} to {$this->to}";
    }
}
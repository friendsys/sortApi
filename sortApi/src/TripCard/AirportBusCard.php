<?php

namespace App\TripCard;

readonly class AirportBusCard extends TripCard
{
    /**
     * @param string $from Source point
     * @param string $to Destination point
     * @param string|null $seat Seat number
     */
    public function __construct(
        private string  $from,
        private string  $to,
        private ?string $seat = null
    )
    {
        parent::__construct($from, $to);
    }

    private function getSeat(): ?string
    {
        return null === $this->seat ?: ', seat №' . $this->seat;
    }

    public function getDescription(): string
    {
        $chunks = [
            'Take the airport bus from ' . $this->from,
            'to ' . $this->to,
            $this->getSeat()
        ];
        return implode('', $chunks);
    }
}

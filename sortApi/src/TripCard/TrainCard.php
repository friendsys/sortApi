<?php

namespace App\TripCard;

readonly class TrainCard extends TripCard
{
    /**
     * @param string $from Source point
     * @param string $to Destination point
     * @param string|null $number Train number
     * @param string|null $seat Seat number
     */
    public function __construct(
        private readonly string  $from,
        private readonly string  $to,
        private readonly ?string $number = null,
        private readonly ?string $seat = null,
    )
    {
        parent::__construct($from, $to);
    }

    private function getNumber():?string
    {
        return null === $this->number ? false : '№'.$this->number;
    }

    private function getSeat():?string
    {
        return null === $this->seat ?: ', seat №'.$this->seat;
    }
    public function getDescription(): string
    {
        $chunks = [
            'Take train ',
            $this->getNumber(),
            ' from ' . $this->from,
            ' to ' . $this->to,
            $this->getSeat(),
        ];

        return implode('', $chunks);
    }
}
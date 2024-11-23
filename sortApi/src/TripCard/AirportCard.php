<?php

namespace App\TripCard;

use InvalidArgumentException;

readonly class AirportCard extends TripCard
{
    /**
     * @param string $from Source point
     * @param string $to Destination point
     * @param string $flight Flight number
     * @param string $gate Gage number
     * @param string $seat Seat number
     * @param bool $luggageAuto Is luggage will be transferred automatically
     * @param int|null $luggageTicketCounter Ticket counter number if luggage will not be transferred automatically
     * @throws InvalidArgumentException
     */
    public function __construct(
        private readonly string $from,
        private readonly string $to,
        private readonly string $flight,
        private readonly string $gate,
        private readonly string $seat,
        private readonly bool $luggageAuto = true,
        private readonly ?int $luggageTicketCounter = null,
    )
    {
        parent::__construct($from, $to);
        if (!$this->luggageAuto && null === $this->luggageTicketCounter) {
            throw new InvalidArgumentException('If luggageAuto is null, make sure to set luggageTicketCounter');
        }
    }

    private function getLuggageInfo(): string
    {
        return $this->luggageAuto
            ? 'Luggage will be automatically transferred from your last leg.'
            : 'Luggage drop at ticket counter №' . $this->luggageTicketCounter;
    }

    public function getDescription(): string
    {
        $chunks = [
            'From ' . $this->from,
            ' take flight №' . $this->flight,
            ' to ' . $this->to,
            '. Gate ' . $this->gate,
            '. Seat ' . $this->seat,
            '. Baggage ' . $this->getLuggageInfo(),
        ];
        return implode('', $chunks);
    }
}
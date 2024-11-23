<?php

namespace App;

use LogicException;
use InvalidArgumentException;
use App\TripCard\TripCard;

class SortApi
{
    /**
     * @param TripCard[] $cards List of TripCard objects
     */
    public function __construct(private array $cards = [])
    {
    }

    /**
     * Append one trip card to cards list
     * @param TripCard $card
     * @return self
     */
    public function appendCard(TripCard $card): self
    {
        $this->cards[] = $card;
        return $this;
    }

    /**
     * Private method for sort trip cards. Return sorted list of trip cards
     * @return TripCard[]
     * @throws LogicException|InvalidArgumentException
     */
    private function sortCards(): array
    {
        // check if cards list is not empty
        if (count($this->cards) < 2) {
            throw new LogicException('At least two travel cards should be provided');
        }

        // Check for cards type and fill paths
        $path = [];
        $reverse_path = [];
        foreach ($this->cards as $card) {
            if (!$card instanceof TripCard) {
                throw new \InvalidArgumentException('At least one trip card is not instance of TripCard');
            }
            $path[$card->getFrom()] = $card;
            $reverse_path[$card->getTo()] = $card;
        }

        // determination of the place of departure
        $map = array_diff_key($path, $reverse_path);
        if (count($map) !== 1) {
            throw new LogicException('Determination of the place of departure failed.');
        }

        // make sorted path
        $sorted_path = [];
        $current_card = reset($map);
        while ($current_card) {
            $sorted_path[] = $current_card;
            $current_card = $path[$current_card->getTo()] ?? null;
        }

        // check if path is continuous
        if (count($sorted_path) < count($this->cards)) {
            throw new LogicException('Cards do not form a continuous path.');
        }
        return $sorted_path;
    }

    /**
     * Return array of strings, contain sorted path based on current trip cards list
     * @return string[]
     * @throws LogicException|InvalidArgumentException
     */
    public function getSortedRoute():array
    {
        return array_map(fn(TripCard $card) => $card->getDescription(), $this->sortCards());
    }
}
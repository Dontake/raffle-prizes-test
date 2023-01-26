<?php

namespace App\Services\Prize\Type;

use App\Entities\Prize\Type\PlayableEntityInterface;

interface PrizeTypeInterface
{
    /**
     * Play prize
     */
    public function play(int $userId): PlayableEntityInterface;

    /**
     * Refuse from played prize
     */
    public function refuse(PlayableEntityInterface $playable): bool;
}

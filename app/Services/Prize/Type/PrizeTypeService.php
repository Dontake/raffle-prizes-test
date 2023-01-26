<?php

namespace App\Services\Prize\Type;

use App\Entities\Prize\Type\PlayableEntityInterface;

class PrizeTypeService
{
    private PrizeTypeInterface $type;

    public function setType(PrizeTypeInterface $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function play(int $userId): PlayableEntityInterface
    {
        return $this->type->play($userId);
    }

    public function refuse(PlayableEntityInterface $playable): bool
    {
        return $this->type->refuse($playable);
    }
}

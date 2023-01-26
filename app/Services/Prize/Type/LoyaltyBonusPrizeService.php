<?php

namespace App\Services\Prize\Type;

use App\Entities\Prize\Type\PlayableEntityInterface;
use App\Exceptions\Api\InsufficientFunds;
use App\Repositories\LoyaltyBonus\LoyaltyBonusRepoInterface;

class LoyaltyBonusPrizeService implements PrizeTypeInterface
{
    /**
     * @param LoyaltyBonusRepoInterface $bonusRepo
     */
    public function __construct(protected LoyaltyBonusRepoInterface $bonusRepo){}

    public function play(int $userId): PlayableEntityInterface
    {
        return $this->bonusRepo->accrue($userId, rand(1000, 10000));
    }

    /**
     * @throws InsufficientFunds
     */
    public function refuse(PlayableEntityInterface $playable): bool
    {
        if (!$this->bonusRepo->checkBalance($playable->getId(), $playable->getCount())) {
            throw new InsufficientFunds();
        }

        return $this->bonusRepo->decreaseBalance($playable->getId(), $playable->getCount());
    }
}

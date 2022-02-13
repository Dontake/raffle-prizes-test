<?php

namespace App\Services\Loyalty;

use App\Repositories\LoyaltyBonus\LoyaltyBonusRepoInterface;

class BonusService implements LoyaltyBonusServiceInterface
{
    public function __construct(protected LoyaltyBonusRepoInterface $bonus){}

    public function accrue(int $userId, float $amount): bool
    {
        return $this->accrue($userId, $amount);
    }
}

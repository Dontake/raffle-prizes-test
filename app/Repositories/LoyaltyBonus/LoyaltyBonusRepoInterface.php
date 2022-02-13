<?php

namespace App\Repositories\LoyaltyBonus;

interface LoyaltyBonusRepoInterface
{
    public function accrue(int $userId, float $amount): bool;
}

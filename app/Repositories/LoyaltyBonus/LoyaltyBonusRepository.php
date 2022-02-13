<?php

namespace App\Repositories\LoyaltyBonus;

use App\Models\Loyalty\LoyaltyBonuses;

class LoyaltyBonusRepository implements LoyaltyBonusRepoInterface
{
    public function accrue(int $userId, float $amount): bool
    {
        return LoyaltyBonuses::firstOrNew(['user_id' => $userId])
            ->increaseBalance($amount);
    }
}

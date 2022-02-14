<?php

namespace App\Repositories\LoyaltyBonus;

use App\Models\Loyalty\LoyaltyBonus;
use App\Models\User\UserCashAccount;

class LoyaltyBonusRepository implements LoyaltyBonusRepoInterface
{
    /**
     * Accrue bonuses for user
     *
     * @param int $userId
     * @param float $amount
     * @return bool
     */
    public function accrue(int $userId, float $amount): bool
    {
        return LoyaltyBonus::firstOrNew(['user_id' => $userId])
            ->increaseBalance($amount);
    }

    /**
     * Balance checking
     *
     * @param int $userId
     * @param float $amount
     * @return bool
     */
    public function checkBalance(int $userId, float $amount): bool
    {
        return LoyaltyBonus::where('user_id', $userId)
            ->where('balance', '>=', $amount)
            ->sharedLock()
            ->exists();
    }

    /**
     * Balance decreasing
     *
     * @param int $userId
     * @param float $amount
     * @return bool|int
     */
    public function decreaseBalance(int $userId, float $amount): bool|int
    {
        return LoyaltyBonus::where('user_id', $userId)
            ->decrement('balance', $amount);
    }

    /**
     * Get monetary equivalent of bonus
     * @return string
     */
    public function getDefaultCurrency(): string
    {
        return LoyaltyBonus::DEFAULT_CURRENCY;
    }

    /**
     * Get currency for monetary equivalent
     * @return float
     */
    public function getMonetaryEquivalent(): float
    {
        return LoyaltyBonus::DEFAULT_MONETARY_EQUIVALENT;
    }
}

<?php

namespace App\Services\Loyalty;

use Exception;

interface LoyaltyBonusServiceInterface
{
    /**
     * Accrue bonuses for user
     *
     * @param int $userId
     * @param float $amount
     * @return bool
     */
    public function accrue(int $userId, float $amount): bool;

    /**
     * Decreasing balance bonuses
     *
     * @param int $userId
     * @param float $amount
     * @return bool
     * @throws Exception
     */
    public function decreaseBalance(int $userId, float $amount): bool;

    /**
     * Convert cash into loyalty bonuses
     *
     * @param float $cash
     * @param string $currency
     * @return int|float
     */
    public function cashToBonusConvert(float $cash, string $currency): int|float;
}

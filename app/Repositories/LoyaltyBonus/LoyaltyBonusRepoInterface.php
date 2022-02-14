<?php

namespace App\Repositories\LoyaltyBonus;

use Exception;

interface LoyaltyBonusRepoInterface
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
     * Get monetary equivalent of bonus
     * @return float
     */
    public function getMonetaryEquivalent(): float;

    /**
     * Get currency for monetary equivalent
     * @return string
     */
    public function getDefaultCurrency(): string;

    /**
     * Decreasing balance bonuses
     *
     * @param int $userId
     * @param float $amount
     * @return bool|int
     * @throws Exception
     */
    public function decreaseBalance(int $userId, float $amount): bool|int;

    /**
     * Balance checking
     *
     * @param int $userId
     * @param float $amount
     * @return bool
     */
    public function checkBalance(int $userId, float $amount): bool;
}

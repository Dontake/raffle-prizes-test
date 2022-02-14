<?php

namespace App\Services\Loyalty;

use App\Repositories\LoyaltyBonus\LoyaltyBonusRepoInterface;
use Exception;

class BonusService implements LoyaltyBonusServiceInterface
{
    /**
     * @param LoyaltyBonusRepoInterface $bonus
     */
    public function __construct(protected LoyaltyBonusRepoInterface $bonus){}

    /**
     * Accrue bonuses for user
     *
     * @param int $userId
     * @param float $amount
     * @return bool
     */
    public function accrue(int $userId, float $amount): bool
    {
        return $this->bonus->accrue($userId, $amount);
    }

    /**
     * Decreasing balance on user account
     *
     * @param int $userId
     * @param float $amount
     * @return bool
     * @throws Exception
     */
    public function decreaseBalance(int $userId, float $amount): bool
    {
        if (!$this->bonus->checkBalance($userId, $amount)){
            throw new Exception('Insufficient funds to write off');
        }

        $this->bonus->decreaseBalance($userId, $amount);

        return true;
    }

    /**
     * Convert cash into loyalty bonuses
     *
     * @param float $cash
     * @param string $currency
     * @return int|float
     */
    public function cashToBonusConvert(float $cash, string $currency): int|float
    {
        return $currency === $this->bonus->getDefaultCurrency()
            ? (int) round($cash * $this->bonus->getMonetaryEquivalent())
            : $cash;
    }
}

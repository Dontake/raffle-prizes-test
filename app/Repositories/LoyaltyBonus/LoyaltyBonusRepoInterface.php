<?php

namespace App\Repositories\LoyaltyBonus;

use App\Entities\Prize\Type\PrizeLoyaltyBonusTypeEntity;
use Exception;

interface LoyaltyBonusRepoInterface
{
    /**
     * Accrue bonuses for user
     */
    public function accrue(int $userId, float $amount): PrizeLoyaltyBonusTypeEntity;

    /**
     * Decreasing balance bonuses
     */
    public function decreaseBalance(int $id, float $amount): bool|int;

    /**
     * Balance checking
     */
    public function checkBalance(int $id, float $amount): bool;
}

<?php

namespace App\Services\Loyalty;

interface LoyaltyBonusServiceInterface
{
    public function accrue(int $userId, float $amount): bool;
}

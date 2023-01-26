<?php

namespace App\Repositories\LoyaltyBonus;

use App\Entities\Prize\Type\PrizeLoyaltyBonusTypeEntity;
use App\Enums\LoyaltyBonus\LoyaltyBonusMonetaryEnum;
use App\Enums\Wallet\WalletCurrencyEnum;
use App\Models\Loyalty\LoyaltyBonus;
use Throwable;

class LoyaltyBonusRepository implements LoyaltyBonusRepoInterface
{
    /**
     * Accrue bonuses for user
     * @throws Throwable
     */
    public function accrue(int $userId, float $amount): PrizeLoyaltyBonusTypeEntity
    {
        $bonus = LoyaltyBonus::firstOrNew(['user_id' => $userId]);
        $bonus->balance += $amount;
        $bonus->is_active = true;
        $bonus->currency = WalletCurrencyEnum::USD;
        $bonus->monetary_equivalent = LoyaltyBonusMonetaryEnum::USD_EQUIVALENT;

        $bonus->saveOrFail();

        return (new PrizeLoyaltyBonusTypeEntity())->setId($bonus->id)
            ->setCount($bonus->balance)
            ->setUserId($userId)
            ->setIsActive($bonus->is_active)
            ->setCurrency($bonus->currency)
            ->setMonetaryEquivalent($bonus->monetary_equivalent);
    }

    /**
     * Balance checking
     */
    public function checkBalance(int $id, float $amount): bool
    {
        return LoyaltyBonus::where('id', $id)
            ->where('balance', '>=', $amount)
            ->sharedLock()
            ->exists();
    }

    /**
     * Balance decreasing
     */
    public function decreaseBalance(int $id, float $amount): bool|int
    {
        return LoyaltyBonus::where('id', $id)
            ->decrement('balance', $amount);
    }
}

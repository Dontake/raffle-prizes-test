<?php

namespace App\Repositories\Cash;

use App\Models\User\UserCashAccount;

class CashAccountRepository implements CashAccountRepositoryInterface
{
    /**
     * Balance checking
     *
     * @param int $userId
     * @param float $amount
     * @return bool
     */
    public function checkBalance(int $userId, float $amount): bool
    {
        return UserCashAccount::where('user_id', $userId)
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
        return UserCashAccount::where('user_id', $userId)
            ->decrement('balance', $amount);
    }

    /**
     * Balance increasing
     *
     * @param int $userId
     * @param float $amount
     * @return bool|int
     */
    public function increaseBalance(int $userId, float $amount): bool|int
    {
        return UserCashAccount::firstOrNew(['user_id' => $userId])
            ->increaseBalance($amount);
    }
}

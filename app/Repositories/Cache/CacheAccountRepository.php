<?php

namespace App\Repositories\Cache;

use App\Models\User\UserCashAccount;

class CacheAccountRepository implements CacheAccountRepositoryInterface
{
    public function checkBalance(int $userId, float $amount): bool
    {
        return UserCashAccount::where('user_id', $userId)
            ->where('balance', '>=', $amount)
            ->exists();
    }

    public function decreaseBalance(int $userId, float $amount): bool|int
    {
        return UserCashAccount::where('user_id', $userId)
            ->decrement('balance', $amount);
    }

    public function increaseBalance(int $userId, float $amount): bool|int
    {
        return UserCashAccount::firstOrNew(['user_id' => $userId])
            ->incrementBalance($amount);
    }
}

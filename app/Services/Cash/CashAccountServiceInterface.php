<?php

namespace App\Services\Cash;

use Exception;

interface CashAccountServiceInterface
{
    /**
     * Increasing balance on user account
     *
     * @param int $userId
     * @param float $amount
     * @return bool
     * @throws Exception
     */
    public function increaseBalance(int $userId, float $amount): bool;

    /**
     * Decreasing balance on user account
     *
     * @param int $userId
     * @param float $amount
     * @return bool
     * @throws Exception
     */
    public function decreaseBalance(int $userId, float $amount): bool;
}

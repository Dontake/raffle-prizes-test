<?php

namespace App\Repositories\Cash;

interface CashAccountRepositoryInterface
{
    /**
     * Balance checking
     *
     * @param int $userId
     * @param float $amount
     * @return bool
     */
    public function checkBalance(int $userId, float $amount): bool;

    /**
     * Balance decreasing
     *
     * @param int $userId
     * @param float $amount
     * @return bool|int
     */
    public function decreaseBalance(int $userId, float $amount): bool|int;

    /**
     * Balance increasing
     *
     * @param int $userId
     * @param float $amount
     * @return bool|int
     */
    public function increaseBalance(int $userId, float $amount): bool|int;
}

<?php

namespace App\Repositories\User\UserWallet;

use App\Entities\Prize\Type\PrizeMoneyTypeEntity;

interface UserWalletRepositoryInterface
{
    /**
     * Find user wallet
     */
    public function find(int $id): PrizeMoneyTypeEntity;

    /**
     * Find user wallet by userId
     */
    public function findForUser(int $userId): PrizeMoneyTypeEntity;

    /**
     * Balance checking
     */
    public function checkBalance(int $userId, float $amount): bool;

    /**
     * Balance decreasing
     */
    public function decreaseBalance(int $userId, float $amount): bool|int;

    /**
     * Balance increasing
     */
    public function increaseBalance(int $userId, float $amount): bool|int;
}

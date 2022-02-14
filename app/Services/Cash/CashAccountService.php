<?php

namespace App\Services\Cash;

use App\Repositories\Cash\CashAccountRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;

class CashAccountService implements CashAccountServiceInterface
{
    public function __construct(
        protected CashAccountRepositoryInterface $cacheAccount,
        protected UserRepositoryInterface        $user
    ){}

    /**
     * Increasing balance on user account
     *
     * @param int $userId
     * @param float $amount
     * @return bool
     * @throws Exception
     */
    public function increaseBalance(int $userId, float $amount): bool
    {
        $sponsorId = $this->user->getSponsorId();

        if (!$this->cacheAccount->checkBalance($sponsorId, $amount)){
            throw new Exception('Недостаточно средств для перевода');
        }

        $this->cacheAccount->decreaseBalance($sponsorId, $amount);
        $this->cacheAccount->increaseBalance($userId, $amount);

        return true;
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
        $sponsorId = $this->user->getSponsorId();

        if (!$this->cacheAccount->checkBalance($userId, $amount)){
            throw new Exception('Недостаточно средств для списания');
        }

        $this->cacheAccount->decreaseBalance($userId, $amount);
        $this->cacheAccount->increaseBalance($sponsorId, $amount);

        return true;
    }
}

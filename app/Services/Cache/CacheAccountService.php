<?php

namespace App\Services\Cache;

use App\Repositories\Cache\CacheAccountRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;

class CacheAccountService implements CacheAccountServiceInterface
{
    public function __construct(
        protected CacheAccountRepositoryInterface $cacheAccount,
        protected UserRepositoryInterface $user
    ){}

    /**
     * @throws Exception
     */
    public function increaseBalance(int $userId, float $amount): bool
    {
        $sponsorId = $this->user->getSponsorId();

        if (!$this->cacheAccount->checkBalance($sponsorId, $amount)){
            throw new Exception('Недостаточно средств для перевода');
        }

        DB::beginTransaction();

        $this->cacheAccount->decreaseBalance($sponsorId, $amount);
        $this->cacheAccount->increaseBalance($userId, $amount);

        DB::commit();

        return true;
    }
}

<?php

namespace App\Repositories\User\UserWallet;

use App\Entities\Prize\Type\PrizeMoneyTypeEntity;
use App\Enums\Wallet\WalletCurrencyEnum;
use App\Models\User\UserWallet;
use Illuminate\Support\Str;
use Throwable;

class UserWalletRepository implements UserWalletRepositoryInterface
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
        return UserWallet::where('user_id', $userId)
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
        return UserWallet::where('user_id', $userId)
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
        return UserWallet::firstOrNew(['user_id' => $userId])
            ->increaseBalance($amount);
    }

    public function find(int $id): PrizeMoneyTypeEntity
    {
        $wallet = UserWallet::findOrFail($id);

        return (new PrizeMoneyTypeEntity())->setId($wallet->id)
            ->setUserId($wallet->user_id)
            ->setCurrency($wallet->currency)
            ->setIsActive($wallet->is_active)
            ->setAccount($wallet->account);
    }

    /**
     * @throws Throwable
     */
    public function findForUser(int $userId): PrizeMoneyTypeEntity
    {
        $wallet = UserWallet::firstOrNew(['user_id' => $userId]);
        $wallet->account = Str::random();
        $wallet->currency = WalletCurrencyEnum::USD;
        $wallet->is_active = true;
        $wallet->saveOrFail();

        return (new PrizeMoneyTypeEntity())->setId($wallet->id)
            ->setUserId($wallet->user_id)
            ->setCurrency($wallet->currency)
            ->setIsActive($wallet->is_active)
            ->setAccount($wallet->account);
    }
}

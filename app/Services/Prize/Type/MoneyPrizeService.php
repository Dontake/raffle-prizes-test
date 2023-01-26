<?php

namespace App\Services\Prize\Type;

use App\Entities\Prize\Type\PlayableEntityInterface;
use App\Exceptions\Api\InsufficientFunds;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\User\UserWallet\UserWalletRepositoryInterface;

class MoneyPrizeService implements PrizeTypeInterface
{
    public function __construct(
        protected UserWalletRepositoryInterface $userWalletRepository,
        protected UserRepositoryInterface $userRepository
    ){}

    /**
     * @throws InsufficientFunds
     */
    public function play(int $userId): PlayableEntityInterface
    {
        $sponsorId = $this->userRepository->getSponsorId();

        $wallet = $this->userWalletRepository->findForUser($userId);
        $amount = rand(10, 1000);

        $this->runTransaction($sponsorId, $userId, $amount);

        return $wallet->setCount($amount);
    }

    /**
     * @throws InsufficientFunds
     */
    public function refuse(PlayableEntityInterface $playable): bool
    {
        $sponsorId = $this->userRepository->getSponsorId();
        $wallet = $this->userWalletRepository->find($playable->getId());

        return $this->runTransaction($wallet->getUserId(), $sponsorId, $playable->getCount());
    }

    /**
     * @throws InsufficientFunds
     */
    private function runTransaction(int $fromUserId, int $toUserId, float $amount): bool
    {
        if (!$this->userWalletRepository->checkBalance($fromUserId, $amount)){
            throw new InsufficientFunds();
        }

        $this->userWalletRepository->decreaseBalance($fromUserId, $amount);
        $this->userWalletRepository->increaseBalance($toUserId, $amount);

        return true;
    }
}

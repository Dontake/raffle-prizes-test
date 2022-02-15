<?php

namespace App\Services\Prize;

use App\Models\Prize\Prize;
use App\Repositories\Prize\PrizeRepoInterface;
use App\Services\Article\ArticleServiceInterface;
use App\Services\Cash\CashAccountServiceInterface;
use App\Services\Loyalty\LoyaltyBonusServiceInterface;
use Illuminate\Support\Facades\DB;
use Exception;
use Throwable;

class PrizeService implements PrizeServiceInterface
{
    /**
     * @param PrizeRepoInterface $prize
     * @param ArticleServiceInterface $articleService
     * @param LoyaltyBonusServiceInterface $bonusService
     * @param CashAccountServiceInterface $cacheAccountService
     */
    public function __construct(
        protected PrizeRepoInterface           $prize,
        protected ArticleServiceInterface      $articleService,
        protected LoyaltyBonusServiceInterface $bonusService,
        protected CashAccountServiceInterface  $cacheAccountService
    ){}

    /**
     * Refuse from prize
     *
     * @param int $id
     * @param int $userId
     * @return bool
     * @throws Throwable
     */
    public function refuse(int $id, int $userId): bool
    {
        if (!$this->prize->exists($id)) {
            throw new Exception('Prize not found');
        }

        $countPrize = $this->prize->getCount($id);

        DB::beginTransaction();

        try {
            match ($this->prize->getCurrentType($id)) {
                Prize::TYPE_MONEY => $this->cacheAccountService->decreaseBalance($userId, $countPrize),
                Prize::TYPE_ARTICLE => $this->articleService->increaseCount($userId),
                Prize::TYPE_LOYALTY_BONUS => $this->bonusService->decreaseBalance($userId, $countPrize),
            };

            $this->prize->delete($id);

            DB::commit();

        } catch (Exception $e) {
            DB::rollback();
        }

        return true;
    }
}

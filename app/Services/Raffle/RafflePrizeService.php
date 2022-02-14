<?php

namespace App\Services\Raffle;

use App\Entities\DTO\PrizeDTO;
use App\Models\Prize\Prize;
use App\Repositories\Prize\PrizeRepoInterface;
use App\Services\Article\ArticleServiceInterface;
use App\Services\Cash\CashAccountServiceInterface;
use App\Services\Loyalty\LoyaltyBonusServiceInterface;
use Exception;
use Illuminate\Support\Facades\DB;
use Throwable;

class RafflePrizeService implements RaffleInterface
{
    /*** @var string */
    private string $status = Prize::STATUS_RAFFLED;

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
     * Run raffle prize
     *
     * @param int $userId
     * @return PrizeDTO
     * @throws Throwable
     */
    public function run(int $userId): PrizeDTO
    {
        $prize = $this->prize;
        $prizeTypes = $prize->getTypes();

        DB::beginTransaction();

        $prize = match ($prizeTypes[rand(0, count($prizeTypes) - 1)]) {
            $prize->getBonusType() => $this->raffleBonus($userId, rand(1000, 10000)),
            $prize->getArticleType() => $this->raffleArticle($userId),
            $prize->getMoneyType() => $this->raffleMoney($userId, rand(100, 1000))
        };

        DB::commit();

        return $prize;
    }

    /**
     * Raffle prize article
     *
     * @param int $userId
     * @return PrizeDTO
     */
    public function raffleArticle(int $userId): PrizeDTO
    {
        $articleId = $this->articleService->firstRandomId();
        $this->articleService->decreaseCount($articleId);

        return $this->prize->save(new PrizeDTO(
            $userId,
            $articleId,
            $this->prize->getArticleType(),
            $this->status,
            1
        ));
    }

    /**
     * Raffle prize bonus
     *
     * @param int $userId
     * @param float $amount
     * @return PrizeDTO
     */
    public function raffleBonus(int $userId, float $amount): PrizeDTO
    {
        $this->bonusService->accrue($userId, $amount);
        return $this->prize->save(new PrizeDTO(
            $userId,
            null,
            $this->prize->getBonusType(),
            $this->status,
            $amount
        ));
    }

    /**
     * Raffle prize money
     *
     * @param int $userId
     * @param float $amount
     * @return PrizeDTO
     * @throws Exception
     */
    public function raffleMoney(int $userId, float $amount): PrizeDTO
    {
        $this->cacheAccountService->increaseBalance($userId, $amount);
        return $this->prize->save(new PrizeDTO(
            $userId,
            null,
            $this->prize->getMoneyType(),
            $this->status,
            $amount
        ));
    }
}

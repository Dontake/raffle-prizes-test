<?php

namespace App\Services\Raffle;

use App\Entities\DTO\PrizeDTO;
use App\Models\Prize\Prize;
use App\Repositories\Article\ArticleRepository;
use App\Repositories\Cache\CacheAccountRepository;
use App\Repositories\LoyaltyBonus\LoyaltyBonusRepository;
use App\Repositories\Prize\PrizeRepository;
use App\Repositories\User\UserRepository;
use App\Services\Article\ArticleService;
use App\Services\Cache\CacheAccountService;
use App\Services\Loyalty\BonusService;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class RafflePrizeService implements RaffleInterface
{
    /**
     * @var string
     */
    private string $status = Prize::STATUS_RAFFLED;

    /**
     * @param PrizeRepository $prize
     */
    public function __construct(protected PrizeRepository $prize){}

    /**
     * @throws Exception
     */
    public function run(int $userId): PrizeDTO
    {
        $prize = $this->prize;
        $prizeTypes = $prize->getTypes();

        return match ($prizeTypes[rand(0, count($prizeTypes))]) {
            $prize->getBonusType() => $this->ruffleBonus($userId, rand(1000, 10000)),
            $prize->getArticleType() => $this->ruffleArticle($userId),
            $prize->getMoneyType() => $this->ruffleMoney($userId, rand(100, 1000))
        };
    }

    /**
     * @param int $userId
     * @return PrizeDTO
     */
    public function ruffleArticle(int $userId): PrizeDTO
    {
        return $this->prize->save(new PrizeDTO(
            $userId,
            (new ArticleService(new ArticleRepository()))->firstRandomId(),
            $this->prize->getArticleType(),
            $this->status,
            1
        ));
    }

    /**
     * @param int $userId
     * @param float $amount
     * @return PrizeDTO
     */
    public function ruffleBonus(int $userId, float $amount): PrizeDTO
    {
        (new BonusService(new LoyaltyBonusRepository()))->accrue($userId, $amount);
        return $this->prize->save(new PrizeDTO(
            $userId,
            null,
            $this->prize->getBonusType(),
            $this->status,
            $amount
        ));
    }

    /**
     * @throws Exception
     */
    public function ruffleMoney(int $userId, float $amount): PrizeDTO
    {
        (new CacheAccountService(
            new CacheAccountRepository(), new UserRepository())
        )->increaseBalance($userId, $amount);

        return $this->prize->save(new PrizeDTO(
            $userId,
            null,
            $this->prize->getMoneyType(),
            $this->status,
            $amount
        ));
    }

    /**
     * @return Collection|array
     */
    public function getRaffledMoney(): Collection|array
    {
        return $this->prize->getRaffledMoney();
    }
}

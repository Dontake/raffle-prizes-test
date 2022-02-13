<?php

namespace App\Repositories\Prize;

use App\Entities\DTO\PrizeDTO;
use App\Models\Prize\Prize;
use Illuminate\Database\Eloquent\Collection;

class PrizeRepository implements PrizeRepoInterface
{
    /**
     * @param PrizeDTO $prizeDTO
     * @return PrizeDTO
     */
    public function save(PrizeDTO $prizeDTO): PrizeDTO
    {
        /** @var Prize $newPrize */
        $newPrize = (new Prize())->setUserId($prizeDTO->getUserId())
            ->setArticleId($prizeDTO->getArticleId())
            ->setType($prizeDTO->getType())
            ->setStatus($prizeDTO->getStatus())
            ->setCount($prizeDTO->getCount())
            ->save();

        return new PrizeDTO(
            $newPrize->getUserId(),
            $newPrize->getArticleId(),
            $newPrize->getType(),
            $newPrize->getStatus(),
            $newPrize->getCount()
        );
    }

    public function getRaffledMoney(): Collection|array
    {
        return Prize::with('user')->select('id, count')
            ->where('type', $this->getMoneyType())
            ->where('status', Prize::STATUS_RAFFLED)
            ->get();
    }

    /**
     * @return array
     */
    public function getTypes(): array
    {
        return Prize::TYPES;
    }

    /**
     * @return string
     */
    public function getBonusType(): string
    {
        return Prize::TYPE_LOYALTY_BONUS;
    }

    /**
     * @return string
     */
    public function getArticleType(): string
    {
        return Prize::TYPE_ARTICLE;
    }

    /**
     * @return string
     */
    public function getMoneyType(): string
    {
        return Prize::TYPE_MONEY;
    }
}

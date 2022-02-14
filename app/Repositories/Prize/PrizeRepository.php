<?php

namespace App\Repositories\Prize;

use App\Entities\DTO\PrizeDTO;
use App\Models\Prize\Prize;
use Illuminate\Database\Eloquent\Collection;

class PrizeRepository implements PrizeRepoInterface
{
    /**
     * Save new Prize
     * @param PrizeDTO $prizeDTO
     * @return PrizeDTO
     */
    public function save(PrizeDTO $prizeDTO): PrizeDTO
    {
        $newPrize = (new Prize())->setUserId($prizeDTO->getUserId())
            ->setArticleId($prizeDTO->getArticleId())
            ->setType($prizeDTO->getType())
            ->setStatus($prizeDTO->getStatus())
            ->setCount($prizeDTO->getCount());

        $newPrize->save();

        return new PrizeDTO(
            $newPrize->getUserId(),
            $newPrize->getArticleId(),
            $newPrize->getType(),
            $newPrize->getStatus(),
            $newPrize->getCount(),
            $newPrize->getId(),
            $newPrize->getName()
        );
    }

    /**
     * Get raffled prizes of money type
     * @param int $count
     * @return Collection|array
     */
    public function getRaffledMoney(int $count): Collection|array
    {
        return Prize::with('user')->select('id', 'count', 'user_id')
            ->where('type', $this->getMoneyType())
            ->where('status', Prize::STATUS_RAFFLED)
            ->limit($count)
            ->get();
    }

    /**
     * Get prize types
     * @return array
     */
    public function getTypes(): array
    {
        return Prize::TYPES;
    }

    /**
     * Get prize bonus type
     * @return string
     */
    public function getBonusType(): string
    {
        return Prize::TYPE_LOYALTY_BONUS;
    }

    /**
     * Get prize article type
     * @return string
     */
    public function getArticleType(): string
    {
        return Prize::TYPE_ARTICLE;
    }

    /**
     * Get prize money type
     * @return string
     */
    public function getMoneyType(): string
    {
        return Prize::TYPE_MONEY;
    }

    /**
     * Check exists prize
     * @param int $id
     * @return bool
     */
    public function exists(int $id): bool
    {
        return Prize::where('id', $id)->sharedLock()->exists();
    }

    /**
     * Detach curren user of prize
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return Prize::destroy($id);
    }

    /**
     * Get prize current type
     *
     * @param int $id
     * @return string
     */
    public function getCurrentType(int $id): string
    {
        return Prize::select('type')
            ->where('id', $id)
            ->first()
            ->getType();
    }

    /**
     * Get prize count
     * @param int $id
     * @return float
     */
    public function getCount(int $id): float
    {
        return Prize::select('count')
            ->where('id', $id)
            ->first()
            ->getType();
    }
}

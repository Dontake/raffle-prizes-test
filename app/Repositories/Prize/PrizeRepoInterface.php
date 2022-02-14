<?php

namespace App\Repositories\Prize;

use App\Entities\DTO\PrizeDTO;
use Illuminate\Database\Eloquent\Collection;

interface PrizeRepoInterface
{
    /**
     * Save new Prize
     * @param PrizeDTO $prizeDTO
     * @return PrizeDTO
     */
    public function save(PrizeDTO $prizeDTO): PrizeDTO;

    /**
     * Get raffled prizes of money type
     * @param int $count
     * @return Collection|array
     */
    public function getRaffledMoney(int $count): Collection|array;

    /**
     * Get prize types
     * @return array
     */
    public function getTypes(): array;

    /**
     * Get prize bonus type
     * @return string
     */
    public function getBonusType(): string;

    /**
     * Get prize article type
     * @return string
     */
    public function getArticleType(): string;

    /**
     * Get prize current type
     *
     * @param int $id
     * @return string
     */
    public function getCurrentType(int $id): string;

    /**
     * Get prize money type
     * @return string
     */
    public function getMoneyType(): string;

    /**
     * Check exists prize
     * @param int $id
     * @return bool
     */
    public function exists(int $id): bool;

    /**
     * Delete prize
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;
}

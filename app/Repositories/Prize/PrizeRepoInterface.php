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
     * Get prize current type
     *
     * @param int $id
     * @return string
     */
    public function getCurrentType(int $id): string;

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

    /**
     * Check status !== sent
     * @param int $id
     * @return bool
     */
    public function checkNotSent(int $id): bool;
}

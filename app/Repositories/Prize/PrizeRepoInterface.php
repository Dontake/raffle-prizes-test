<?php

namespace App\Repositories\Prize;

use App\Entities\Prize\PrizeEntity;
use App\Entities\Prize\Type\PlayableEntityInterface;
use Illuminate\Database\Eloquent\Collection;

interface PrizeRepoInterface
{
    /**
     * Get playable entity
     */
    public function getPlayable(int $id): PlayableEntityInterface;

    /**
     * Save new Prize
     */
    public function save(PrizeEntity $prizeEntity): PrizeEntity;

    /**
     * Get raffled prizes of money type
     */
    public function getPlayedMoney(int $count): Collection|array;

    /**
     * Delete prize
     */
    public function delete(int $id): bool;

    /**
     * Check status !== sent
     */
    public function checkNotSent(int $id): bool;
}

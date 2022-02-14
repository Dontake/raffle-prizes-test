<?php

namespace App\Services\Raffle;

use App\Entities\DTO\PrizeDTO;
use Throwable;

interface RaffleInterface
{
    /**
     * Run raffle prize
     *
     * @param int $userId
     * @return PrizeDTO
     * @throws Throwable
     */
    public function run(int $userId): PrizeDTO;
}

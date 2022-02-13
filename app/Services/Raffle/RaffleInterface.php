<?php

namespace App\Services\Raffle;

use App\Entities\DTO\PrizeDTO;

interface RaffleInterface
{
    public function run(int $userId): PrizeDTO;
}

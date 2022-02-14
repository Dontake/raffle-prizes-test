<?php

namespace App\Services\Prize;

interface PrizeServiceInterface
{
    /**
     * Refuse from prize
     *
     * @param int $id
     * @param int $userId
     * @return bool
     */
    public function refuse(int $id, int $userId): bool;
}
